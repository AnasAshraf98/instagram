<div class="self-center">
    <button wire:model="accept-follow" wire:click="toggleAccept({{$user_id}})"
    class="text-blue-500 font-semibold hover:text-blue-400" style="margin-right: 15px">{{__($status)}}</button>
</div>
