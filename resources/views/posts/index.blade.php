<x-app-layout>
    <div class="flex flex-row max-w-3xl gap-8 mx-auto">
        {{-- left side --}}

        <div class="w-[30rem] mx-auto lg:w-[95rem]">
            @forelse ($posts as $post)
                <x-post :post='$post' />
            @empty
                <div class="max-w-2xl gap-8 mx-auto">
                    {{ __('Start Following Your Friends and Enjoy.') }}
                </div>
            @endforelse
        </div>

        {{-- right side --}}

        <div class="hidden w-[60-rem] lg:flex lg:flex-col pt-4"></div>
    </div>
</x-app-layout>
