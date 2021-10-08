<x-app-layout>
    <x-slot name="header">
        <header>
            <div class="grid grid-cols-5 gap-4">
                <div class="col-start-2 col-span-1 flex justify-center w-auto mt-5">
                    <img class="w-40 h-40 rounded-full" src="{{$user->profile_photo_url}}" alt="{{$user->username}}">
                </div>
                <div class="col-start-3 col-span-2 flex justify-start items-center w-auto m-0">
                    <div class="grid grid-rows-2">
                        <div class="flex flex-row items-center">
                            <h1 class="font-light text-3xl me-14">
                                {{$user->username}}
                            </h1>
                            @if (Auth::user() != null && Auth::user()->name == $user->name) 
                                
                            
                            <a style="margin-left: 20px" href="{{route('profile.show')}}" class="border border-solid border-gray-300 rounded-md py-0 px-5 me-16 whitespace-nowrap">
                                {{__('Edit Profile')}}
                            </a>
                            <a style="margin-left: 20px" href="/posts/create">
                                <x-jet-button class="ms-8 leading-none whitespace-nowrap">
                                    {{__('Add Post')}}
                                </x-jet-button>
                            </a>
                            @else
                                @livewire('follow-button', ['user_id' => $user->id], key($user->id))
                            @endif    
                        </div>
                        <div>
                            <ul class="flex flex-row mb-5">
                                <li class="me-10 cursor-pointer"><span class="font-semibold">{{$user->posts->count()}}</span> {{__('posts')}}</li>
                                <li style="margin-left: 20px" class="me-10"><a href="{{route('followers')}}">
                                    <span class="font-semibold">
                                        {{$user->followers()->count()}}
                                    </span></a> {{__('followers')}}</li>
                                <li style="margin-left: 20px" class="me-10"><a href="{{route('following')}}">
                                    <span class="font-semibold">
                                        {{$user->follows()->count()}}
                                    </span></a> {{__('following')}}</li>
                            </ul>
                            <p class="mb-1 font-black">{{$user->name}}</p>
                            <p>{{$user->bio}}</p>
                            <p class="text-blue-500"><a href="{{$user->url}}">{{$user->url}}</a></p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </header>
    </x-slot>

    <div class="max-w-4xl my-0 mx-auto">
        <hr class="mb-10">
        @if($user->status == "public")
            <div class="grid grid-cols-3 gap-4 mx-0 mt-0 mb-6">
                @foreach($posts as $post)
                <div class="post">
                    <a href="/posts/{{$post->id}}" class="w-full h-full">
                        <img src="/storage/{{$post->image_path}}" class="w-full h-full object-cover">
                        <div class="post-info">
                            <ul>
                                <li class="inline-block font-semibold me-7">
                                    <span class="absolute h-1 w-1 overflow-hidden ">{{__('Likes:')}}</span>
                                    <i class="fas fa-heart" aria-hidden="true"></i>
                                    {{$post->likedByUsers()->count()}}
                                </li>

                                <li class="inline-block font-semibold">
                                    <span class="absolute h-1 w-1 overflow-hidden ">{{__('Comments:')}}</span>
                                    <i class="fas fa-comment" aria-hidden="true"></i>
                                    {{$post->comments()->count()}}
                                </li>
                            </ul>
                        </div>
                    </a>
                </div>
                @endforeach
                <div class="col-span-3 mt-10">
                    {{$posts->links()}}
                </div>
            </div>
        @else
        
            @can('view-profile', $user)
                
            <div class="grid grid-cols-3 gap-4 mx-0 mt-0 mb-6">
                @foreach($posts as $post)
                <div class="post">
                    <a href="/posts/{{$post->id}}" class="w-full h-full">
                        <img src="/storage/{{$post->image_path}}" class="w-full h-full object-cover">
                        <div class="post-info">
                            <ul>
                                <li class="inline-block font-semibold me-7">
                                    <span class="absolute h-1 w-1 overflow-hidden ">{{__('Likes:')}}</span>
                                    <i class="fas fa-heart" aria-hidden="true"></i>
                                    {{$post->likedByUsers()->count()}}
                                </li>

                                <li class="inline-block font-semibold">
                                    <span class="absolute h-1 w-1 overflow-hidden ">{{__('Comments:')}}</span>
                                    <i class="fas fa-comment" aria-hidden="true"></i>
                                    {{$post->comments()->count()}}
                                </li>
                            </ul>
                        </div>
                    </a>
                </div>
                @endforeach
                <div class="col-span-3 mt-10">
                    {{$posts->links()}}
                </div>
            </div>
            @else
                <div>
                    <h1 class="text-center">
                        {{__('This account is private')}}
                    </h1>
                    <p class="text-center">
                        {{__('Follow to see their posts')}}
                    </p>
                </div>
            @endcan
        @endif    
    </div>
</x-app-layout>
