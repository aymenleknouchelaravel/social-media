<x-app-layout>
    <div class="grid grid-cols-3 gap-1 ms:gap-5 mt-8">
        @foreach ($posts as $post)
            <div>
                <a href="/p/{{ $post->slug }}">
                    <img src="/storage/{{ $post->image }}" alt="image" class="w-full aspect-square object-cover">
                </a>
            </div>
        @endforeach
    </div>
    <div class="p-5">
        {{ $posts->links()}}
    </div>
</x-app-layout>
