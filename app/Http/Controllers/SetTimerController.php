<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SetTimer;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class SetTimerController extends Controller
{
    public function index()
    {
        $setTimers = SetTimer::paginate(5);
        return view('backend.settimers.index', compact('setTimers'));
    }

    public function create()
    {
        // Fetch all products
        $products = Product::whereNotIn('id', function ($query) {
            $query->select('product_id')->from('set_timers');
        })->get();

        // Return the view with products data
        return view('backend.settimers.create', compact('products'));
    }

    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'product_id' => 'required|exists:products,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ];

        // Validate the request data
        $validatedData = $request->validate($rules);

        // Create a new SetTimer instance
        $setTimer = new SetTimer();
        $setTimer->product_id = $validatedData['product_id'];
        $setTimer->start_time = $validatedData['start_time'];
        $setTimer->end_time = $validatedData['end_time'];

        // Save the SetTimer instance
        $setTimer->save();

        // Redirect back with a success message
        return redirect()->route('settimers.index')->with('success', 'Set Timer created successfully.');
    }

    public function edit($id)
    {
        $setTimer = SetTimer::with('product')->find($id);

        // dd($setTimer);

        if (!$setTimer) {
            return redirect()->route('settimers.index')->with('error', 'Set timer not found.');
        }

        // Access the product's name through the relationship
        $productName = $setTimer->product->name;

        return view('backend.settimers.edit', compact('setTimer', 'productName'));
    }

    public function update(Request $request, $productId)
    {

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'start_time' => 'date',
            'end_time' => 'date|after:start_time',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        
        // Update the set timer with the new start and end times based on the product ID
        SetTimer::where('id', $productId)->update([
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        // Redirect back to the set timers index page with a success message
        return redirect()->route('settimers.index')->with('success', 'Set timers updated successfully.');
    }

    public function destroy($id)
{
    // Find the set timer by its ID
    $setTimer = SetTimer::find($id);

    // Check if the set timer exists
    if (!$setTimer) {
        return redirect()->route('settimers.index')->with('error', 'Set timer not found.');
    }

    // Delete the set timer
    $setTimer->delete();

    // Redirect back to the index page with a success message
    return redirect()->route('settimers.index')->with('success', 'Set timer deleted successfully.');
}


}
