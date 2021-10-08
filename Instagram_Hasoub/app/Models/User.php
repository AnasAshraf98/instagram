<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'bio',
        'url',
        'email',
        'password',
        'status',
        'accepted',
        'language',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function posts(){
        return $this->hasMany(Post::class)->orderBy('created_at','DESC');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function follows(){  
        return $this->belongsToMany(User::class,'follows','user_id','following_user_id');
    }

    public function followers(){
        return $this->belongsToMany(User::class,'follows','following_user_id','user_id');
    }

    public function following(User $user){
        return $this->follows()->where('following_user_id',$user->id)->exists();
    }

    public function setAccepted(User $user){
        if($user->status=="public"){
            DB::table('follows')
            ->where('user_id',$this->id)
            ->where('following_user_id',$user->id)
            ->update([
                'accepted' => true,
            ]);
        }
    }

    public function accepted(User $user){
        if($this->status == "public"){
            return true;
        }   
        else{
            return(bool) DB::table('follows')
            ->where('user_id',$user->id)
            ->where('following_user_id',$this->id)
            ->where('accepted',true)
            ->count();
        }
    }

    public function followReq(){
        if($this->status == "private"){
            return $this->followers()
            ->where('following_user_id',$this->id)
            ->where('accepted',false)
            ->latest()->paginate(5);
        }
        return null;
    }
    
    public function pendingFollowReq(){
        return $this->follows()
        ->where('user_id',$this->id)
        ->where('accepted',false)
        ->latest()->paginate(5);
    }

    public function followAndAccepted(User $user){
        return $this->follows()->where('following_user_id',$user->id)->where('accepted',true)->exists();
    }

    public function toggleAccepted(User $user,$state){
        return DB::table('follows')
        ->where('user_id',$user->id)
        ->where('following_user_id',$this->id)
        ->update([
            'accepted' => $state,
        ]);
    }

    public function home(){
        $ids=$this->follows()->where('accepted',true)->get()->pluck('id');
        return Post::whereIn('user_id', $ids)->latest()->paginate(10);
    }

    public function iFollow(){
        return $this->follows()
        ->where('user_id',$this->id)
        ->where('accepted',true)
        ->latest()->get();
    }

    public function otherUsers(){
        $iFollow=$this->iFollow()->pluck('id')->toArray();
        $pendingFollow=$this->pendingFollowReq()->pluck('id')->toArray();
        array_push($iFollow,$this->id);
        $others=array_merge($iFollow,$pendingFollow);
        return User::whereNotIn('id',$others)->latest()->get();
    }

    public function explore(){
        $iFollow=$this->iFollow()->pluck('id')->toArray();
        array_push($iFollow,$this->id);
        $public=User::where('status','private')->pluck('id')->toArray();
        $others=array_merge($iFollow,$public);

        return Post::whereNotIn('user_id',$others)->latest()->paginate(10);
    }
}
