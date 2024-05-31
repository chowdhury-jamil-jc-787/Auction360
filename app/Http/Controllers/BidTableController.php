<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Bid;
use Illuminate\Support\Facades\DB;

class BidTableController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $roleName = null;

        if ($user) {
            $roleName = $user->roles->first()->name ?? null;
        }

        $query = Bid::query();

        if ($roleName != 'Super Admin') {
            $query->whereHas('product', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where('user_id', '!=', $user->id);
        }

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('product', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        $bids = $query->orderBy('created_at', 'desc')->paginate(5);

        if ($request->ajax()) {
            return response()->json([
                'bids' => view('backend.bids.partials.bids_table', compact('bids'))->render(),
                'pagination' => (string) $bids->links(),
            ]);
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
