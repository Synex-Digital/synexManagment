<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault([
            'name' => 'Unknown'
        ]);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class)->withDefault([
            'user' => 'unknown'
        ]);
    }
}
