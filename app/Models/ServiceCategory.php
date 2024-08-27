<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name','title', 'slug', 'description', 'is_active'];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
