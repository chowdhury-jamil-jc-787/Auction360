<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\gallery\StoregalleryRequest;
use App\Http\Requests\gallery\UpdateGalleryRequest;

class GalleryController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:gallery-list|gallery-create|gallery-edit|gallery-delete|gallery-show|gallery-trashed|gallery-trashed-restore|gallery-trashed-delete', ['only' => ['index','show']]);
        $this->middleware('permission:gallery-create', ['only' => ['create','store']]);
        $this->middleware('permission:gallery-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:gallery-delete', ['only' => ['destroy']]);
        $this->middleware('permission:gallery-show', ['only' => ['show']]);
        $this->middleware('permission:gallery-trashed', ['only' => ['trashed']]);
        $this->middleware('permission:gallery-trashed-restore', ['only' => ['restore']]);
        $this->middleware('permission:gallery-trashed-delete', ['only' => ['delete']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Determine the number of items per page
        $perPage = $request->input('per_page', 10);

        // Retrieve paginated galleries
        $galleries = Gallery::latest()->paginate($perPage);

        // Pass the paginated galleries to the view
        return view('backend.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoregalleryRequest $request)
    {
        $input = $request->all();

        if ($image = $request->file('image')) {
            $input['image'] = $this->uploadImage($request->file('image'));
        }

        Gallery::create($input);

        return redirect()->route('galleries.index')
                        ->with('success','Gallery created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        return view('backend.gallery.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('backend.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdategalleryRequest $request, Gallery $gallery)
    {

        $input = $request->all();

        if ($image = $request->file('image')) {
            $input['image'] = $this->uploadImage($request->file('image'));
        } else {
            unset($input['image']);
        }

        $gallery->update($input);

        return redirect()->route('galleries.index')
                        ->with('success', 'Gallery updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();

        return redirect()->route('galleries.index')
                        ->with('success', 'Gallery deleted successfully');
    }

    public function trashed()
    {
        $trashed = Gallery::onlyTrashed()->latest()->get();
        return view('backend.gallery.trashed', compact('trashed'));
    }

    public function restore($id)
    {
        Gallery::onlyTrashed()->find($id)->restore();
        return redirect()->route('galleries.trashed')
            ->with('success', 'Gallery restored successfully.');
    }

    public function delete($id)
    {
        Gallery::onlyTrashed()->find($id)->forceDelete();
        return redirect()->route('galleries.trashed')
            ->with('success', 'Gallery permanently deleted successfully.');
    }

    public function uploadImage($file)
    {
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $filePath = 'storage/gallery/' . $fileName;
        Image::make($file)
            ->resize(500, 500)
            ->save(storage_path() . '/app/public/gallery/' . $fileName);

        return $filePath;
    }
}
