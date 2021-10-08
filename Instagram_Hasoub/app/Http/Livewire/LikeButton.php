<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class LikeButton extends Component
{
    public $post_id;
    private $post;
    public $isLike;
    public $likeCount;

    public function mount($post_id){
        $this->post=Post::find($post_id);

        if($this->post!=null&&auth()->user()!=null){
            $this->post->likedByUser(auth()->user()) ? $this->isLike=true : $this->isLike=false;
        }

        $this->likeCount=$this->post->likedByUsers()->count();
    }

    public function ToggleLike($post_id){
        $this->post=Post::find($post_id);

        if($this->post!=null&&auth()->user()!=null){
            $this->post->likedByUsers()->toggle(auth()->user());
            $this->post->likedByUser(auth()->user()) ? $this->isLike=true : $this->isLike=false;
        }
        else{
            redirect(route('login'));
        }

        $this->likeCount=$this->post->likedByUsers()->count();
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
