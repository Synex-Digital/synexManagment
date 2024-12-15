<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public function support(){
        return $this->hasMany(Support::class, 'customer_id');
    }
    public function latestSupport()
{
    return $this->hasOne(Support::class, 'customer_id')->latest('created_at');
}
}
