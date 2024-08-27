<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Helpers\Photo;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = Blog::all();
        $category = Category::all();
        $employee = Employee::all();
        return view('dashboard.blog.index', [
            'blog'          => $blog,
            'categories'    => $category,
            'employees'    =>$employee,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blog = Blog::all();
        $category = Category::all();
        $employee = Employee::all();
        return view('dashboard.blog.create', [
            'blog'          => $blog,
            'categories'    => $category,
            'employees'     => $employee,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id'       => 'required',
            'employee_id'       => 'required',
            'title'             => 'required',
            'content'           => 'required',
            'seo_title'         => 'required',
            'seo_tags'          => 'required',
            'seo_description'   => 'required',
            'image'             => 'required|image|mimes:jpeg,png,jpg,webp,jfif|max:1024',
        ]);

        $blog = new Blog();

        //Uploading
        Photo::upload($request->image, 'uploads/blog/photo/blog', 'BLOG', [640, 420]);

        $blog->category_id      = $request->category_id;
        $blog->employee_id      = $request->employee_id;
        $blog->title            = $request->title;
        $blog->content          = $request->content;
        $blog->image            = Photo::$name?Photo::$name:'Null';
        $blog->seo_title        = $request->seo_title;
        $blog->seo_description  = $request->seo_description;
        $blog->seo_tags         = $request->seo_tags;
        $blog->status           = $request->status;
        if($request->slug != null){
            $blog->slug         = $request->slug;
        }
        else{
            $blog->slug         = Str::slug($request->title, '-');
        }
        $blog->save();

        return back()->with('success', 'Blog created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::find($id);
        $category = Category::all();
        $employee = Employee::all();
        return view('dashboard.blog.show', [
            'blog'          => $blog,
            'categories'    => $category,
            'employees' =>$employee,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::find($id);
        $category = Category::all();
        $employee = Employee::all();
        return view('dashboard.blog.edit', [
            'blog'          => $blog,
            'categories'    => $category,
            'employees' =>$employee,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title'             => 'required',
            'content'           => 'required',
            'slug'              => 'required',
            'seo_title'         => 'required',
            'seo_tags'          => 'required',
            'seo_description'   => 'required',
        ]);

        $blog->category_id      = $request->category_id;
        $blog->employee_id      = $request->employee_id;
        $blog->title            = $request->title;
        $blog->content          = $request->content;
        $blog->seo_title        = $request->seo_title;
        $blog->seo_description  = $request->seo_description;
        $blog->seo_tags         = $request->seo_tags;
        $blog->status           = $request->status;
        $blog->slug             = $request->slug;

        if ($request->has('image')) {
            Photo::delete($blog->image);
            Photo::upload($request->image, 'uploads/blog/photo/blog', 'BLOG', [640, 420]);
            $blog->image = Photo::$name?Photo::$name:'Null';
        }


        $blog->save();
        return back()->with('success', 'Blog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::find($id);
        Photo::delete($blog->image);
        $blog->delete();

        return back()->with('danger', 'Blog deleted!!');
    }
}
