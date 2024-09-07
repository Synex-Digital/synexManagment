<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Helpers\Photo;
use App\Models\Category;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->can('blog.view')){
            $blog = Blog::all();
            $category = Category::all();
            $employee = Employee::all();
            return view('dashboard.blog.index', [
                'blog'          => $blog,
                'category'    => $category,
                'employees'    =>$employee,
            ]);
        }else{
            return redirect()->route('dashboard');
        }

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
        
        if(auth()->user()->can('blog.create')){
            $validator = Validator::make($request->all(), [
            'category_id'       => 'required',
            'employee_id'       => 'required',
            'title'             => 'required',
            'content'           => 'required',
            'seo_title'         => 'required',
            'seo_tags'          => 'required',
            'seo_description'   => 'required',
            'image'             => 'required|image|mimes:jpeg,png,jpg,webp,jfif|max:1024',
        ],[
            'category_id'       => 'Blog category required',
            'employee_id'       => 'Blog employee required',
            'title'             => 'Blog title required',
            'content'           => 'Blog content required',
            'seo_title'         => 'Blog seo title required',
            'seo_tags'          => 'Blog seo tags required',
            'seo_description'   => 'Blog seo description required',
            'image'             => 'Blog image required',
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
        flash()->options([ 'position' => 'bottom-right', ])->success('Blog Created successfully');
        return back();
        }else{
            return redirect()->route('dashboard');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(auth()->user()->can('blog.view')){
            $blog = Blog::find($id);
        $category = Category::all();
        $employee = Employee::all();
        return view('dashboard.blog.show', [
            'blog'          => $blog,
            'categories'    => $category,
            'employees' =>$employee,
        ]);
        }else{
            return redirect()->route('dashboard');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(auth()->user()->can('blog.edit')){
            $blog = Blog::find($id);
        $category = Category::all();
        $employee = Employee::all();
        return view('dashboard.blog.blog_edit', [
            'blog'          => $blog,
            'categories'    => $category,
            'employees' =>$employee,
        ]);
        }else{
            return redirect()->route('dashboard');
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        if(auth()->user()->can('blog.edit')){
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
        flash()->options([ 'position' => 'bottom-right', ])->success('Blog updated successfully');
        return redirect()->route('blog.index');
        }else{
            return redirect()->route('dashboard');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(auth()->user()->can('blog.delete')){
            $blog = Blog::find($id);
            Photo::delete($blog->image);
            $blog->delete();
            flash()->options([ 'position' => 'bottom-right', ])->success('Blog deleted successfully');
            return back();
        }else{
            return redirect()->route('dashboard');
        }

    }
}
