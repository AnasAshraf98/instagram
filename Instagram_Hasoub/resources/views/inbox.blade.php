<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="grid grid-cols-12 mt-7 gap-4">
        <div class="col-start-5 col-span-4">
            <h3 class="mt-4 mb-4 text-gray-500 font-semibold text-center text-3xl">
                {{__('Follow Requests:')}}
            </h3>
           {{--  @if (is_array($requests)) --}}
                
            
            @if ($requests!=null&&sizeof($requests)>0) 
                @foreach ($requests as $request)
                    <div class="flex flex-col mb-3">
                        <div class="flex flex-row justify-center">
                            <div class="flex flex-row">
                                <a href="/{{$request->username}}">
                                    <img src="{{$request->profile_photo_url}}" alt="avatar" class="rounded-full h-10 w-10 me-3">
                                </a>
                                <div class="flex flex-col self-center">
                                    <a href="/{{$request->username}}" class="text-base hover:underline whitespace-nowrap">
                                        {{$request->username}}
                                    </a>
                                    <h3 class="text-sm text-gray-500 truncate whitespace-nowrap" style="max-width:25ch">
                                        {{ $request->bio}}
                                    </h3>    
                                </div> 
                            </div>
                            @if($user->status=="private")
                                @livewire('accept-follow', ['user_id' => $request->id], key($request->username))
                            @endif
                            @livewire('follow-button', ['user_id' => $request->id], key($request->id))

                        </div>
                    </div>
                @endforeach
                <div class="col-span-3 mt-10">
                    {{$requests->links()}}
                </div>
            @else
                <div class="my-10 text-center">
                    <p class="font-semibold">
                        {{__('Nothing to show right now!')}}
                    </p>
                </div>
            @endif 

            <h3 class="mt-4 mb-4 text-gray-500 font-semibold text-center text-3xl">
                {{__('Pending Sent Requests:')}}
            </h3>

            @if ($pendings!=null&&sizeof($pendings)>0) 
                @foreach ($pendings as $pending)
                    <div class="flex flex-col mb-3">
                        <div class="flex flex-row justify-center">
                            <div class="flex flex-row">
                                <a href="/{{$pending->username}}">
                                    <img src="{{$pending->profile_photo_url}}" alt="avatar" class="rounded-full h-10 w-10 me-3">
                                </a>
                                <div class="flex flex-col self-center">
                                    <a href="/{{$pending->username}}" class="text-base hover:underline whitespace-nowrap">
                                        {{$pending->username}}
                                    </a>
                                    <h3 class="text-sm text-gray-500 truncate whitespace-nowrap" style="max-width:25ch">
                                        {{ $pending->bio}}
                                    </h3>    
                                </div> 
                            </div>
                            @livewire('follow-button', ['user_id' => $pending->id], key($pending->id))
                        </div>
                    </div>
                @endforeach
                <div class="col-span-3 mt-10">
                    {{$pendings->links()}}
                </div>
            @else
                <div class="my-10 text-center">
                    <p class="font-semibold">
                        {{__('Nothing to show right now!')}}
                    </p>
                </div>
            @endif
            {{-- @endif  --}}
        </div>
    </div>
</x-app-layout>