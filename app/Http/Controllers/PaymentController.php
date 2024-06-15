<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;

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

}
