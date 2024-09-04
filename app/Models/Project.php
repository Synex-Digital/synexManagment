<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['leader_id','member_id'];

    public function leader(){
        return $this->belongsTo(User::class,'leader_id','id');
    }


    public function members(){
        return $this->belongsTo(User::class,'member_id','id');
    }


    public function client(){
        return $this->belongsTo(Client::class,'client_id','id');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id', 'id');
    }
    public function scopeWithMember($query, $userId)
    {
        return $query->whereRaw("FIND_IN_SET(?, member_id)", [$userId]);
    }


}
