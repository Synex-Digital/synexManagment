<?php

namespace App\Http\Controllers;

use App\Helpers\Photo;
use App\Models\Category;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

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
       $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
       ],[
        'name' => 'Category name required',
        'slug' => 'Category slug required',
       ]);
       if ($validator->fails()) {
        $errors = $validator->errors();
        foreach ($errors->messages() as  $messages) {
            foreach ($messages as $message) {
                flash()->options([
                    'position' => 'bottom-right',
                ])->error($message);
            }
        }
        return back()->withErrors($validator)->withInput();
        }

        $category = new Category();
        Photo::upload($request->image, 'uploads/blog/photo/category', 'CAT', [640, 480]);
        $category->name             = $request->name;
        $category->seo_title        = $request->seo_title;
        $category->seo_description  = $request->seo_description;
        $category->seo_tags         = $request->seo_tags;
        $category->image            = Photo::$name?Photo::$name:'Null';
        $category->status           = $request->status;
        $category->slug             = $request->slug ;
        $category->save();
        flash()->options([ 'position' => 'bottom-right', ])->success('Category created successfully');
        return back();
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
        return view('dashboard.blog.category_edit', [
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
        ]);

        $category->name             = $request->name;
        $category->seo_title        = $request->seo_title;
        $category->seo_description  = $request->seo_description;
        $category->seo_tags         = $request->seo_tags;
        $category->status           = $request->status;
        $category->slug             = $request->slug ;


        if ($request->has('image')) {
            Photo::delete($category->image);
            Photo::upload($request->image, 'uploads/blog/photo/category', 'CAT', [640, 480]);
            $category->image = Photo::$name;
        }else{
            $category->image = 'Null';
        }

        $category           ->save();
        flash()->options([ 'position' => 'bottom-right', ])->success('Category Updated successfully');
        return redirect(route('blog.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        Photo::delete($category->image);
        $category->delete();
        flash()->options([ 'position' => 'bottom-right', ])->success('Category Deleted successfully');
        return back();
    }
}
