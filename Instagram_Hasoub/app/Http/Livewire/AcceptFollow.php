<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AcceptFollow extends Component
{
    private $user;
    public $user_id;
    public $status;

    public function mount($user_id){
        $this->user=User::find($user_id);

        if($this->user!=null&&auth()->user()!=null){
            auth()->user()->accepted($this->user) ? $this->status="Accepted" : $this->status="Accept" ;
        }
    }

    public function toggleAccept($user_id){
        $this->user=User::find($user_id);

        if($this->user!=null&&auth()->user()!=null){
            if(auth()->user()->accepted($this->user)){
                auth()->user()->toggleAccepted($this->user,false);
                auth()->user()->accepted($this->user) ? $this->status="Accepted" : $this->status="Accept" ;
            }
            else{
                auth()->user()->toggleAccepted($this->user,true);
                auth()->user()->accepted($this->user) ? $this->status="Accepted" : $this->status="Accept" ;
            }
        }
    }

    public function render()
    {
        return view('livewire.accept-follow');
    }
}
