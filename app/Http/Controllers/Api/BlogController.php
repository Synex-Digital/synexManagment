<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogsResource;
use App\Http\Resources\BlogViewResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('view_count', 'desc')->take(4)->get();
        $bestOne = new BlogsResource($blogs->first());
        $bestThree = BlogsResource::collection($blogs->skip(1)->take(3));

        $latest = BlogsResource::collection(Blog::latest()->paginate(10));
        if ($latest) {
            return response()->json([
                'status' => 1,
                'bests' => [
                    'bestOne' => $bestOne,
                    'bestThree' => $bestThree,
                ],
                'latest' => $latest,
                'pagination' => [
                    'total' => $latest->total(),
                    'count' => $latest->count(),
                    'per_page' => $latest->perPage(),
                    'current_page' => $latest->currentPage(),
                    'total_pages' => $latest->lastPage(),
                ],
            ]);
        }

        return response()->json([
            'status' => 0,
            'message' => 'Not found',
        ], 200);

        return response()->json($blogs);
    }

    public function homeitem()
    {
        $popularBlog = new BlogsResource(Blog::orderBy('view_count', 'desc')->first());
        $blogs = BlogsResource::collection(Blog::get()->take(4));

        if ($blogs) {
            return response()->json([
                'status' => 1,
                'popular' => $popularBlog,
                'blogs' => $blogs,
            ]);
        }

        return response()->json([
            'status' => 0,
            'message' => 'Not found',
        ], 200);

        return response()->json($blogs);
    }

    public function view($slug)
    {
        $fet = Blog::where('slug', $slug)->first();
        if ($fet) {
            $related = BlogsResource::collection(Blog::where('category_id', $fet->category_id)->get()->take(3));
            $popular = BlogsResource::collection(Blog::orderBy('view_count', 'desc')->get()->take(5));
            $category = CategoryResource::collection(Category::all());

            $blog = new BlogViewResource($fet);

            return response()->json([
                'status' => 1,
                'content' => $blog,
                'popular' => $popular,
                'related' => $related,
                'category' => $category,
            ], 200);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Not found',
            ], 200);
        }
    }

    public function sitemap()
    {
        $blog = Blog::select('slug')->where('status', 'active')->get();
        $category = Category::select('slug')->where('status', 'active')->get();

        if ($blog || $category) {
            return response()->json([
                'status' => 1,
                'category' => $category,
                'blogs' => $blog
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Blog not found'
            ]);
        }
    }
}
