<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Helpers\Photo;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('dashboard.category.create', [
            'category'      => $category,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = new Category();

        Photo::upload($request->image, 'uploads/blog/photo/category', 'CAT', [640, 480]);

        $category->name             = $request->name;
        $category->seo_title        = $request->seo_title;
        $category->seo_description  = $request->seo_description;
        $category->seo_tags         = $request->seo_tags;
        $category->image            = Photo::$name?Photo::$name:'Null';
        $category->status           = $request->status;
        if($request->slug != null){
            $category->slug         = $request->slug;
        }
        else{
            $category->slug         = Str::slug($request->name, '-');
        }
        $category->save();
        return back()->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('dashboard.category.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'  => 'required',
            'image' => 'required|mimes:png,jpg,webp,jpeg,svg|max:1024',
        ]);

        $category->name             = $request->name;
        $category->seo_title        = $request->seo_title;
        $category->seo_description  = $request->seo_description;
        $category->seo_tags         = $request->seo_tags;
        $category->status           = $request->status;
        $category->slug             = Str::slug($request->name, '-');


        if ($request->has('image')) {
            Photo::delete($category->image);
            Photo::upload($request->image, 'uploads/blog/photo/category', 'CAT', [640, 480]);
            $category->image = Photo::$name?Photo::$name:'Null';
        }

        $category           ->save();
        return back()       ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        Photo::delete($category->image);
        $category->delete();

        return back()->with('danger', 'Category deleted!!');
    }
}
