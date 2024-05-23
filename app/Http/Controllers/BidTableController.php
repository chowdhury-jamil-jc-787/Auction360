<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Bid;
use Illuminate\Support\Facades\DB;

class BidTableController extends Controller
{
    public function index()
    {
        // Retrieve the authenticated user
        $user = auth()->user();
        $roleName = null;

        // If user exists, get their role name
        if ($user) {
            // Assuming the user has a relationship with roles named 'roles'
            $roleName = $user->roles->first()->name ?? null;
        }

        // Check if the authenticated user is a "Super Admin"
        if ($roleName == 'Super Admin') {
            // Fetch all bids
            $bids = Bid::orderBy('created_at', 'desc')->paginate(5);
        } else {
            $bids = Bid::whereHas('product', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where('user_id', '!=', $user->id) // Exclude bids where the bidder is the authenticated user
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        }

        return view('backend.bids.index', compact('bids'));
    }

    public function status()
    {
        $bids = Bid::where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        return view('backend.bids.status', compact('bids'));
    }


    public function show($id)
    {
        $product = Product::find($id);
        $bids = Bid::where('product_id', $id)->get();
        return view('backend.bids.show', compact('bids', 'product'));
    }
    public function destroy($id)
    {
        $bid = Bid::find($id);
        $bid->delete();
        return redirect()->back()->with('success', 'Bid deleted successfully');
    }


}
