<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Image_slider;
use App\Models\SetTimer;
use App\Models\Product;
use App\Models\Gallery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;


class HomeController extends Controller
{
    public function index()
    {
        // Retrieve the current date and time from the internet
        $currentDateTime = Http::get('https://worldtimeapi.org/api/ip')->json()['datetime'];

        // Query the products table with their associated set_timer end times
        $products = Product::leftJoin('set_timers', 'products.id', '=', 'set_timers.product_id')
            ->select('products.*', 'set_timers.end_time', 'set_timers.status')
            ->where('set_timers.start_time', '<=', $currentDateTime)
            ->where(function ($query) use ($currentDateTime) {
                $query->whereNull('set_timers.end_time')
                    ->orWhere('set_timers.end_time', '>=', $currentDateTime);
            })
            ->where('set_timers.status', 1) // Add condition for status being 1
            ->orderBy('set_timers.start_time', 'desc') // Adjust order as needed
            ->get();

        // Retrieve active categories
        $categories = Category::where('is_active', true)->get();

        // Retrieve active image sliders
        $imageSliders = Image_slider::where('is_active', 1)->get();

        // Retrieve active gallery images
        $galleries = Gallery::where('is_active', 1)->get();

        // Pass the compacted categories, image sliders, products, and galleries to the view
        return view('frontend.home', compact('categories', 'imageSliders', 'products', 'galleries'));
    }


    public function contactUs()
    {
        return view('frontend.contactUs');
    }

    public function aboutUs()
    {
        return view('frontend.aboutUs');
    }

    public function productDetails()
    {
        // Retrieve only active categories
        $categories = Category::where('is_active', true)->get();

        // Initialize an empty collection to store products by category
        $productsByCategory = new Collection();

        // Retrieve the current date and time from the internet
        $currentDateTime = Http::get('https://worldtimeapi.org/api/ip')->json()['datetime'];

        foreach ($categories as $category) {
            $productsByCategory[$category->id] = DB::table('products')
                ->leftJoin('set_timers', 'products.id', '=', 'set_timers.product_id')
                ->select('products.*', 'set_timers.end_time', 'set_timers.status')
                ->where('products.category_id', $category->id)
                ->where('set_timers.start_time', '<=', $currentDateTime)
                ->where(function ($query) use ($currentDateTime) {
                    $query->whereNull('set_timers.end_time')
                          ->orWhere('set_timers.end_time', '>=', $currentDateTime);
                })
                ->where('set_timers.status', 1)
                ->orderBy('set_timers.start_time', 'desc')
                ->paginate(3, ['*'], 'page_' . $category->id);
        }

        // Compact the categories and products by category
        return view('frontend.productDetails', compact('categories', 'productsByCategory'));
    }



}
