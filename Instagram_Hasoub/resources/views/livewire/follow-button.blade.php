<div class="self-center">
    <button class="bg-blue-500 rounded-lg shadow px-2 py-1 text-white" 
    wire:model="follow-button"
    wire:click="ToggleFollowing({{$user_id}})">{{__($following)}}</button>
</div>
