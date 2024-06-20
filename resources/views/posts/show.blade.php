<x-app-layout>

    <div class="h-screen md:flex md:flex-row">

        {{-- left side --}}

        <div class="h-full md:w-7/12 bg-black flex items-center">
            <img src="/storage/{{ $post->image }}" alt="{{ $post->description }}"
                class="max-h-screen object-cover mx-auto">
        </div>

        {{-- right side --}}

        <div class="flex w-full flex-col bg-white md:w-5/12">

            {{-- Top --}}

            <div class="border-b">
                <div class="flex items-center py-5">
                    <img src="{{ $post->owner->image }}" alt="{{ $post->owner->username }}"
                        class="mx-5 h-10 w-10 rounded-full">
                    <a href="/{{ $post->owner->username }}" class="font-bold">{{ $post->owner->username }}</a>
                </div>
            </div>

            {{-- Middle --}}

            <div class="grow overlow-y-auto">

                <p class="ml-5 mb-5 mt-4 text-sm text-gray-400">description</p>

                <div class="flex items-start px-5 mb-5">
                    {{-- <img src="{{ $post->owner->image }}" class="mr-5 h-10 w-10 rounded-full"> --}}
                    <div>
                        <a href="{{ $post->owner->username }}" class="font-bold">{{ $post->owner->username }}</a>
                        {{ $post->description }}
                    </div>
                </div>

                {{-- Comments --}}
                @foreach ($post->comments as $comment)
                    <div class="flex items-strat px-5 mt-2">
                        <img src="{{ $comment->owner->image }}" alt="" class="h-10 mr-5 w-10 rounded-full">
                        <div class="flex flex-col">
                            <div>
                                <a href="/{{ $comment->owner->username }}"
                                    class="font-bold">{{ $comment->owner->username }}</a>
                                {{ $comment->body }}
                            </div>

                            <div class="mt-1 text-sm font-bold text-gray-400">
                                {{ $comment->created_at->shortAbsoluteDiffForHumans() }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- End --}}

            <div class="border-t-2 p-5">
                <form action="/p/{{ $post->slug }}/comment" method="post">
                    @csrf

                    <div class="flex flex-row">
                        <textarea name="body" id="comment-body" placeholder="Add a comment ..." cols="30" rows="10" class="h-5 grow resize-none overflow-hidden border-none p-0 placeholder-gray-400 outline-0 focus:ring-0"></textarea>
                        <button type="submit" class="ml-5 border-none bg-white text-blue-500">Post</button>
                    </div>
                </form>
            </div>



        </div>
    </div>

</x-app-layout>
