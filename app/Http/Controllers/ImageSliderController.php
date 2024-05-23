<?php

namespace App\Http\Controllers;

use App\Models\Image_slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class ImageSliderController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
         $this->middleware('permission:imageSlider-list|imageSlider-create|imageSlider-edit|imageSlider-delete| imageSlider-show|imageSlider-trashed|imageSlider-trashed-restore|imageSlider-trashed-delete', ['only' => ['index','show']]);
         $this->middleware('permission:imageSlider-create', ['only' => ['create','store']]);
         $this->middleware('permission:imageSlider-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:imageSlider-delete', ['only' => ['destroy']]);
         $this->middleware('permission:imageSlider-show', ['only' => ['show']]);
         $this->middleware('permission:imageSlider-trashed', ['only' => ['trashed']]);
         $this->middleware('permission:imageSlider-trashed-restore', ['only' => ['restore']]);
         $this->middleware('permission:imageSlider-trashed-delete', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $products = Product::all();
        // $images = Image_slider::latest()->get();
        // return view('backend.image_slider.index',compact('images'));

        return view('backend.image_slider.index', [
            'images' => Image_slider::orderBy('id','DESC')->paginate(5)
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $images = Image_slider::all();
        return view('backend.image_slider.create', compact('images'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required|max:1000',
            'image' => 'required|mimes:jpg,png,jpeg,webp',
            'is_active' => 'required',
        ]);

        try {
            Image_slider::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $this->uploadImage($request->file('image')),
                'is_active' => $request->is_active,
            ]);

            return redirect()->route('imageslider.list')->withMessage('Image Created Successfully');
        } catch (QueryException $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->withInput()->withErrors('Something went wrong, please try again later!');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $image_slider = Image_slider::find($id);
        return view('backend.image_slider.show',compact('image_slider'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $image_slider = Image_slider::find($id);

        return view('backend.image_slider.edit', compact('image_slider',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required|max:1000',
            'image' => 'nullable|mimes:jpg,png,jpeg,webp',
        ]);

        try {
            $imageSlider = Image_slider::findOrFail($id);

            $dataToUpdate = [
                'title' => $request->title,
                'description' => $request->description,
            ];

            // Check if an image is provided
            if ($request->hasFile('image')) {
                // Validate and upload the new image
                $request->validate([
                    'image' => 'required|mimes:jpg,png,jpeg,webp',
                ]);

                // Upload the new image
                $dataToUpdate['image'] = $this->uploadImage($request->file('image'));
            }

            // Update the is_active field based on checkbox selection
            $dataToUpdate['is_active'] = $request->has('is_active') ? 1 : 0;

            // Update the image slider with the new data
            $imageSlider->update($dataToUpdate);

            return redirect()->route('imageslider.list')->withMessage('Image Updated Successfully');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());

            return redirect()->back()->withInput()->withErrors('Something went wrong. Please try again later.');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $image_slider = Image_slider::find($id);
        $image_slider->delete();
        return redirect()->route('imageslider.list')->withMessage('Image_slide Delete Succesfully');
    }
    public function uploadImage($file)
    {
        $fileName = time(). '.'.$file->getClientOriginalExtension();
        $filePath = 'storage/Image_slider/' . $fileName;

            Image::make($file)
            ->resize(1920,1001)
            ->save(storage_path().'/app/public/Image_slider/'.$fileName);

        return $fileName;
    }

    public function trash(){

        $trashed = Image_slider::onlyTrashed()->get();
        return view('backend.image_slider.trashed',compact('trashed'));

    }

    public function restore($id){
        Image_slider::onlyTrashed()->find($id)->restore();
       // $restoreData = Image_slider::find($id);
        // $restoreData->restore();
        return redirect()->route('imagesliders.trashed')->withMessage(' Succesfully product restore');



    }

    public function delete($id){
        Image_slider::onlyTrashed()->find($id)->restore();
        return redirect()->route('imagesliders.trashed')->withMessage(' Succesfully product permanently Delete');



    }


}
