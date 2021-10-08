<div class="min-h-screen flex flex-row sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        <img src="download.png" alt="logo" class="x1:w-80 x1:h-80 md:w-64 md:h-64 w-0 h-0 me-12">
    </div>
    <div class="flex flex-col">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>

        @if (str_contains(url()->current(), 'login'))
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg flex justify-center items-center">
                <span class="text-sm text-gray-600 pe-5">{{__('Don\'t have an account?')}} <a href="{{ route('register') }}" class="text-blue-700 hover:text-blue-900 text-base font-bold mx-2">{{__('Sign Up')}}</a></span>
            </div>
        @endif
    </div>
</div>
