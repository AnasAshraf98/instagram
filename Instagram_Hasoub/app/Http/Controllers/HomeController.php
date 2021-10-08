<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(){
        if(auth()->user()!=null){
            $user=auth()->user()->username;
            return redirect()->route('user_profile',compact('user'));
        }
        return redirect()->route('login');
    }

    public function index($username){
        
        if(auth()->user()==null){
            abort(403);
        }
        $user=auth()->user();
        $posts=auth()->user()->posts()->paginate(4);
        return view('profile',compact('user','posts'));
    }

    public function followers(){
        $user=auth()->user();
        $followers=auth()->user()->followers()->paginate(5);

        return view('followers',compact('user','followers'));
    }
    
    public function following(){
        $user=auth()->user();
        $following=auth()->user()->follows()->paginate(5);

        return view('following',compact('user','following'));
    }

    public function inbox(){
        $user=auth()->user();
        $requests=$user->followReq();
        $pendings=$user->pendingFollowReq();

        return view('inbox',compact('user','requests','pendings'));
    }

    public function home(){
        
        $posts=auth()->user()->home();
        $profile=auth()->user();
        $iFollow=$profile->iFollow()->take(3);
        $toFollow=$profile->otherUsers()->take(3);
        return view('home',compact('posts','profile','iFollow','toFollow'));
    }

    public function explore(){
        $user=auth()->user();
        $posts=auth()->user()->explore();
        return view('explore',compact('user','posts'));
    }

    public function language($lang){
        if($lang=="ar"||$lang=="en"){
            session(['language' => $lang]);
        }
        else{
            abort(404);
        }
        return redirect()->back();
    }
}
