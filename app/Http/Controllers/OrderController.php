<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Bid;
use App\Models\Product;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Store a newly created order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $bid_id
     * @param  int  $product_id
     * @param  int  $bid_user_id
     * @param  float $price
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $bid_id, $product_id, $bid_user_id, $price)
    {
        // Find the product to get the product_owner_id
        $product = Product::findOrFail($product_id);

        // Create the order
        $order = Order::create([
            'product_id' => $product_id,
            'product_owner_id' => $product->user_id,
            'time' => Carbon::now(),
            'phone_number' => null,
            'transaction_id' => null,
            'price' => $price,
            'payment_by_id' => $bid_user_id,
            'status' => 'pending',
            'bids_id' => $bid_id,
        ]);

        // Update the status of the bid to 'approved'
        $bid = Bid::findOrFail($bid_id);
        $bid->status = 'approved';
        $bid->save();

        return redirect()->back()->with('success', 'Order created successfully!');
    }

    public function reject($bid_id)
    {
        // Find the bid
        $bid = Bid::find($bid_id);

        // Check if bid exists
        if (!$bid) {
            return redirect()->back()->withErrors(['error' => 'Bid not found.']);
        }

        // Delete bid
        $bid->delete();

        // Find the corresponding order and delete if exists
        $order = Order::where('bids_id', $bid_id)->first();
        if ($order) {
            $order->delete();
        }

        // Redirect back with success message
        return redirect()->back()->with('success', 'Bid and corresponding order deleted successfully.');
    }
}

