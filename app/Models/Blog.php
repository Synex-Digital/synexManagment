<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'employee_id',
        'title',
        'content',
        'image',
        'view_count',
        'status',
        'seo_title',
        'seo_description',
        'seo_tags',
        'slug',
    ];

    /**
     * Automatically generate a slug when creating or updating a blog post.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            $blog->slug = Str::slug($blog->title);
        });

        static::updating(function ($blog) {
            $blog->slug = Str::slug($blog->title);
        });
    }



    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault([
            'name' => 'Unknown'
        ]);
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
