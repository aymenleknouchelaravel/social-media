<x-app-layout>
    <div class="flex flex-row max-w-3xl gap-8 mx-auto">

        {{-- left side --}}

        <div class="w-[30rem] mx-auto lg:w-[95rem]">
            @forelse ($posts as $post)
                <x-post :post='$post' />
            @empty
                <div class="max-w-2xl gap-8 mx-auto bg-white p-4 rounded">
                    {{ __('Start Following Your Friends and Enjoy.') }}
                </div>
            @endforelse
            <div class="p-5">
                {{ $posts->links() }}
            </div>
        </div>

        {{-- right side --}}

        <div class="hidden w-[60rem] lg:flex lg:flex-col pt-4">
            <div class="flex flex-row text-sm">
                <div class="mr-5">
                    <a href="/profile/{{ auth()->user()->username }}">
                        @if (filter_var(auth()->user()->image, FILTER_VALIDATE_URL))
                            <img src="{{ auth()->user()->image }}" alt="{{ auth()->user()->username }}"
                                class="border border-gray-300 rounded-full h-12 w-12">
                        @else
                            <img src="{{ asset('storage/' . auth()->user()->image) }}"
                                alt="{{ auth()->user()->username }}"
                                class="border border-gray-300 rounded-full h-12 w-12">
                        @endif

                    </a>
                </div>
                <div class="flex flex-col">
                    <a href="/profile/{{ auth()->user()->username }}"
                        class="font-bold">{{ auth()->user()->username }}</a>
                    <div class="text-gray-500 text-sm">{{ auth()->user()->name }}</div>
                </div>
            </div>
            <div class="mt-5">
                <h3 class="text-gray-500 font-bold">{{ __('Suggestions For You') }}</h3>
                <ul>
                    @foreach ($suggested_users as $suggested_user)
                        <li class="flex flex-row my-5 text-sm justify-items-center">
                            <div class="mr-5">
                                @if (filter_var($suggested_user->image, FILTER_VALIDATE_URL))
                                    <img src="{{ $suggested_user->image }}"
                                        class="rounded-full h-9 w-9 border border-gray-300" />
                                @else
                                    <img src="{{ asset('storage/' . $suggested_user->image) }}"
                                        class="rounded-full h-9 w-9 border border-gray-300" />
                                @endif

                            </div>
                            <div class="flex flex-col grow">
                                <a href="/profile/{{ $suggested_user->username }}"
                                    class="font-bold">{{ $suggested_user->username }}
                                </a>
                                <div class="text-gray-500 text-sm">{{ $suggested_user->name }}</div>
                            </div>
                            <a href="/{{ $suggested_user->username }}/follow"
                                class="text-blue-500 font-bold">{{ __('Follow') }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
