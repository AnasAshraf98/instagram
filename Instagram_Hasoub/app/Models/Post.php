<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'post_caption',
        'image_path',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function likedByUsers(){
        return $this->belongsToMany(User::class,'likes');
    }

    public function likedByUser(User $user){
        return DB::table('likes')
        ->where('user_id',$user->id)
        ->where('post_id',$this->id)
        ->exists();
    }

}
