<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Bid;

class BidController extends Controller
{
    public function index($productId, $userId)
    {
        $product = Product::findOrFail($productId);
        // You can also fetch the user details if needed

        return view('bid', compact('product'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'bid' => 'required|numeric|min:0',
        ]);

        // Check if the user has already bid on the product
        $existingBid = Bid::where('user_id', $validatedData['user_id'])
                        ->where('product_id', $validatedData['product_id'])
                        ->first();

        // If a bid already exists, return with an error message
        if ($existingBid) {
            return back()->with('error', 'You have already placed a bid on this product.');
        }

        // Add status to validated data with default 'pending'
        $validatedData['status'] = 'pending';

        // Create and store the bid
        $bid = Bid::create($validatedData);

        // Redirect the user to the home page
        return redirect('/')->with('success', 'Bid placed successfully.');
    }

}
