<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
     }
    public function departments(){
        return $this->belongsTo(Department::class, 'department_id' );
     }
    public function designations(){
        return $this->belongsTo(Designation::class, 'designation_id' );
     }
     public function socials(){
        return $this->hasMany(Social::class, 'user_id', 'user_id' );
     }
     public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
