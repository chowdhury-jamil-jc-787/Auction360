<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Image_slider;
use App\Models\SetTimer;
use App\Models\Product;
use Illuminate\Support\Facades\Http;


class HomeController extends Controller
{
    public function index()
    {
        // Retrieve the current date and time from the internet
        $currentDateTime = Http::get('https://worldtimeapi.org/api/ip')->json()['datetime'];

        // Query the products table with their associated set_timer end times
        $products = Product::leftJoin('set_timers', 'products.id', '=', 'set_timers.product_id')
            ->select('products.*', 'set_timers.end_time')
            ->where('set_timers.start_time', '<=', $currentDateTime)
            ->where(function ($query) use ($currentDateTime) {
                $query->whereNull('set_timers.end_time')
                    ->orWhere('set_timers.end_time', '>=', $currentDateTime);
            })
            ->orderBy('set_timers.start_time', 'desc') // Adjust order as needed
            ->get();

        // Retrieve active categories
        $categories = Category::where('is_active', true)->get();

        // Retrieve active image sliders
        $imageSliders = Image_slider::where('is_active', 1)->get();

        // Pass the compacted categories, image sliders, and products to the view
        return view('frontend.home', compact('categories', 'imageSliders', 'products'));
    }


}
