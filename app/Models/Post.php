<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];
    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function comments(){
        return $this->hasMany('App\Models\Comment','post_id','id');
    }
}
