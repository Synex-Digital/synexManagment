<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProject extends Model
{
    use HasFactory;
    // Specify the table associated with the model
    protected $table = 'service_projects';

    // Define the fillable attributes
    protected $fillable = [
        'thumbnail_image',
        'company_name',
        'title',
        'short_description',
        'slug',
        'project_url',
        'is_active',
        'service_category_id'
    ];

    // Define any relationships if applicable
    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class)->withDefault([
            'name' => 'Unknown'
        ]);
    }
}
