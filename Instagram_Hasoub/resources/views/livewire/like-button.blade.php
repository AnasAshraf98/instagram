<div class="flex flex-col items-start ps-4 pb-1">
    <div class="flex flex-row items-center">
        <button class="text-2xl me-3 focus:outline-none" wire:model="like-button" wire:click="ToggleLike({{$post_id}})" style="margin-right: 5px;">
            <i class="{{$isLike ? "fas text-red-500" : "far"}} fa-heart"></i>
        </button>
        <button class="text-2xl me-3 focus:outline-none" style="margin-right: 5px"><i class="far fa-comment"></i></button>
        <button class="text-2xl me-3 focus:outline-none"
        onClick="copyToClipBoard({{$post_id}})"
        id="{{$post_id}}"
        value="{{url('')}}/posts/{{$post_id}}"
        style="margin-right: 5px"><i class="far fa-share-square"></i></button>
    </div>
    <span>{{__('Liked by')}} {{$likeCount}}</span>
</div>
