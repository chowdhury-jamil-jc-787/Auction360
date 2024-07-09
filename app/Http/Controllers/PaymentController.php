<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function invoice($bidId)
    {
        // Fetch bid with related user, product and profile information
        $bid = Bid::where('id', $bidId)
            ->where('status', 'approved')
            ->with(['user.profile', 'product'])
            ->first();

        if (!$bid) {
            return response()->json(['message' => 'No approved bid found with the given ID.'], 404);
        }

        $user = $bid->user;
        $profile = $user->profile;
        $product = $bid->product;

        $data = [
            'id' => $bid->id,
            'user_id' => $bid->user_id,
            'bid' => $bid->bid,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'address' => $profile->address,
            'phone_number' => $profile->phone_number,
            'product_name' => $product->name,
        ];

        return view('backend.payments.invoice', compact('data'));
    }

    public function payment($bid_id, Request $request)
{
    // Validate the request data with custom messages
    $request->validate([
        'phone_number' => 'required|string',
        'transaction_id' => 'required|string',
    ], [
        'phone_number.required' => 'The phone number field is required.',
        'transaction_id.required' => 'The transaction ID field is required.',
    ]);

    // Start a database transaction
    DB::beginTransaction();

    try {
        // Find the bid
        $bid = Bid::find($bid_id);

        // Check if bid exists
        if ($bid) {
            // Find the corresponding order
            $order = Order::where('bids_id', $bid_id)->first();

            // Check if order exists and time difference is within 7 days
            if ($order && Carbon::parse($order->time)->diffInDays(Carbon::now()) <= 7) {
                // Update phone_number and transaction_id in the order
                $order->phone_number = $request->phone_number;
                $order->transaction_id = $request->transaction_id;
                $order->save();

                // Update bid status to 'completed'
                $bid->status = 'completed';
                $bid->save();

                // Commit the transaction
                DB::commit();

                return view('backend.payments.success');
            } else {
                return redirect()->back()->withErrors(['error' => 'Time crossed or order not found. Cannot update.']);
            }
        } else {
            return redirect()->back()->withErrors(['error' => 'Bid not found.']);
        }
    } catch (\Exception $e) {
        // Rollback the transaction on exception
        DB::rollback();
        return redirect()->back()->withErrors(['error' => 'Error occurred while processing payment.']);
    }
}




}
