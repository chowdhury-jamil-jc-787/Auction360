<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\category\StorecategoryRequest;
use App\Http\Requests\category\UpdateRequest;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
         $this->middleware('permission:category-list|category-create|category-edit|category-delete| category-show|category-trashed|category-trashed-restore|category-trashed-delete', ['only' => ['index','show']]);
         $this->middleware('permission:category-create', ['only' => ['create','store']]);
         $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:category-delete', ['only' => ['destroy']]);
         $this->middleware('permission:category-show', ['only' => ['show']]);
         $this->middleware('permission:category-trashed', ['only' => ['trashed']]);
         $this->middleware('permission:category-trashed-restore', ['only' => ['restore']]);
         $this->middleware('permission:category-trashed-delete', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Determine the number of items per page
        $perPage = $request->input('per_page', 3);

        // Retrieve paginated categories
        $categories = Category::latest()->paginate($perPage);

        // Pass the paginated categories to the view
        return view('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecategoryRequest $request)
    {
        $input = $request->all();

        if ($image = $request->file('image')) {
            $input['image'] = $this->uploadImage($request->file('image'));
        }

        Category::create($input);

        return redirect()->route('categories.index')
                        ->with('success','Category created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('backend.category.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('backend.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {

        $input = $request->all();

        if ($image = $request->file('image')) {
            $input['image'] = $this->uploadImage($request->file('image'));
        }else{
            unset($input['image']);
        }

        $category->update($input);

        return redirect()->route('categories.index')
                        ->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
                        ->with('success','Category deleted successfully');
    }
    public function trashed()
    {
        $trashed = Category::onlyTrashed()->latest()->get();
        return view('backend.category.trashed',compact('trashed'));
    }
    public function restore($id)
    {
        Category::onlyTrashed()->find($id)->restore();
        return redirect()->route('categories.trashed')
        ->with('success','category restored successfully.');
    }
    public function delete($id)
    {
        Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->route('categories.trashed')
        ->with('success','category permanent deleted successfully.');
    }

    public function uploadImage($file){
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $filePath = 'storage/category/' . $fileName;
        Image::make($file)
            ->resize(500,500)
            ->save(storage_path().'/app/public/category/'.$fileName);

            return $filePath;
    }

}
