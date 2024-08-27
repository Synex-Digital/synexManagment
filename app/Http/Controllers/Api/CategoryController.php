<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogsResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryViewResource;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($slug)
    {
        $category = Category::where('slug', $slug)->first();

        if ($category) {
            $categoryId = $category->id;
            $blog = BlogsResource::collection(Blog::where('category_id', 2)->paginate(10));
            $categoryList = CategoryResource::collection(Category::all());
            // dd($blog);
            return response()->json([
                'status' => 1,
                'category' => new CategoryViewResource($category),
                'category_list' => $categoryList,
                'blog' => $blog,
                'pagination' => [
                    'total' => $blog->total(),
                    'count' => $blog->count(),
                    'per_page' => $blog->perPage(),
                    'current_page' => $blog->currentPage(),
                    'total_pages' => $blog->lastPage(),
                ],
            ], 200);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Not found',
            ], 200);
        }
    }
}
