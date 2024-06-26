<x-app-layout>
    <div class="grid grid-cols-4 card pt-10">
        <div class="{{ session('success') ? '' : 'hidden' }} w-50 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg absolute right-10 shadow shadow-neutral-200"
            role="alert">
            <span class="font-medium">{{ session('success') }}</span>
        </div>

        {{-- User Image --}}

        <div class="px-4 col-span-1 order-1">


            <img src="{{ Str::startsWith($user->image, ['http://', 'https://']) ? $user->image : asset('storage/' . $user->image) }}"
                alt="{{ $user->username }} Profile Image" class="rounded-full w-20 md:w-40 border border-neutral-300">


        </div>

        {{-- Username and Buttons --}}

        <div class="px-4 col-span-2 md:ml-0 flex flex-col order-2 md:col-span-3">
            <div class="text-3xl mb-3">
                {{ $user->username }}
            </div>
            @if ($user->id == auth()->id())
                <a href="/profil/edit/{{ $user->id }}"
                    class="w-44 border text-sm font-bold py-1 rounded-md border-neutral-300 text-center">
                    {{ __('Edit Profile') }}
                </a>
            @elseif(auth()->user()->is_pending($user))
                <span class="w-30 bg-gray-400 text-white px-3 py-1 rounded text-center self-strat">
                    {{ __('Pending') }}
                </span>
            @elseif(auth()->user()->is_follower($user))
                <a href="/{{ $user->username }}/unfollow"
                    class="w-44 border text-sm font-bold py-1 rounded-md border-neutral-300 text-center">
                    {{ __('Unfollow') }}
                </a>
            @else
                <a href="/{{ $user->username }}/follow"
                    class="w-30 bg-blue-400 text-white px-3 py-1 rounded text-center self-start">{{ __('Follow') }}</a>
            @endif
        </div>

        {{-- User Info --}}

        <div class="text-md mt-8 px-4 col-span-3 col-start-1 order-3 md:col-start-2 ms:order-4 md:mt-0">
            <p class="font-bold">{{ $user->name }}</p>
            {!! nl2br(e($user->bio)) !!}
        </div>

        {{-- User State --}}

        <div
            class="col-span-4 my-5 py-2 border-y border-y-neutral-200 order-4 md:order-3 md:border-none md:px-4 md:col-start-2">
            <ul class="text-md flex flex-row justify-around md:justify-start md:space-x-10 md:text-xl">
                <li class="flex flex-col md:flex-row text-center">
                    <div class="md:mr-1 font-bold md:font-normal">
                        {{ $user->posts->count() }}
                    </div>

                    <span class="text-neutral-500 md:text-black">
                        {{ $user->posts->count() > 1 ? 'posts' : 'post' }}
                    </span>
                </li>
                <li class="flex flex-col md:flex-row text-center">
                    <div class="md:mr-1 font-bold md:font-normal">
                        {{ $user->followers->count() }}
                    </div>

                    <span class="text-neutral-500 md:text-black">
                        {{ $user->posts->count() > 1 ? __('Followers') : __('Follower') }}
                    </span>
                </li>
                <li class="flex flex-col md:flex-row text-center">
                    <div class="md:mr-1 font-bold md:font-normal">
                        {{ $user->following()->wherePivot('confirmed', true)->get()->count() }}
                    </div>

                    <span class="text-neutral-500 md:text-black">
                        {{ __('Following') }}
                    </span>
                </li>
            </ul>
        </div>
    </div>

    {{-- Bottom --}}
    @if ($user->posts()->count() > 0 && (!$user->private_account || auth()->id() == $user->id) || auth()->user()->is_follower($user))
        <div class="grid grid-cols-3 gap-1 pb-5">

            @foreach ($user->posts as $post)
                <a href="/p/{{ $post->slug }}/show" class="aspect-square block w-full">
                    <img src="/storage/{{ $post->image }}" alt="{{ $post->description }}"
                        class="w-full aspect-square object-cover">
                </a>
            @endforeach

        </div>
    @else
        <div class="w-full text-center mt-20">

            @if ($user->private_account == true and $user->id != auth()->id())
                {{ __('This Account  is Private. Follow to see theire photos.') }}
            @else
                {{ __('This User does not have any posts.') }}
            @endif

        </div>
    @endif


</x-app-layout>
