<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class FollowButton extends Component
{
    private $user;
    public $user_id;
    public $following="Follow";

    public function mount($user_id){
        $this->user=User::find($user_id);

        if($this->user!=null&&auth()->user()!=null){
            auth()->user()->following($this->user) ? $this->following="Unfollow" : $this->following="Follow";
        }
    }

    public function ToggleFollowing($user_id){
        $this->user=User::find($user_id);

        if($this->user!=null&&auth()->user()!=null){
            auth()->user()->follows()->toggle($this->user);
            auth()->user()->following($this->user) ? $this->following="Unfollow" : $this->following="Follow";
            auth()->user()->setAccepted($this->user);
        }
        else{
            redirect(route('login'));
        }
    }

    public function render()
    {
        return view('livewire.follow-button');
    }
}
