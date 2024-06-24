<div class="card">
    <div class="card-header">
        @if (filter_var($post->owner->image, FILTER_VALIDATE_URL))
            <img src="{{ $post->owner->image }}" alt="" class="w-9 h-9 mr-3 rounded-full">
        @else
            <img src="{{ asset('storage/' . $post->owner->image) }}" alt="" class="w-9 h-9 mr-3 rounded-full">
        @endif
        <a href="/profile/{{ $post->owner->username }}" class="font-bold">{{ $post->owner->username }}</a>
    </div>

    <div class="card-body">

        <div class="max-h-[35rem] overflow-hidden">
            <a href="/p/{{ $post->slug }}/show">
                <img src="/storage/{{ $post->image }}" class="h-auto w-full object-cover"
                    alt="{{ $post->description }}">
            </a>
        </div>

        <div class="p-3">
            <a href="/profile/{{ $post->owner->username }}" class="font-bold mr-1">{{ $post->owner->username }}</a>
            {{ $post->description }}
        </div>

        @if ($post->comments()->count() > 0)
            <a href="/p/{{ $post->slug }}/show" class="p-3 font-bold text-sm text-gray-500">
                {{ __('View all ' . $post->comments()->count() . ' comments') }}
            </a>
        @endif

        <div class="p-3 text-gray-400 uppercase text-xs">
            {{ $post->created_at->diffForHumans() }}
        </div>

    </div>

    <div class="card-footer">
        <form action="/p/{{ $post->slug }}/comment" method="post">
            @csrf
            <div class="flex flex-row">
                <textarea autocomplete="off" name="body" placeholder="{{ __('Add a comment ...') }}"
                    class="grow border-none resize-none focus:ring-0 outline-0 bg-none max-h-60 h-5 p-0 overflow-y-hidden placeholder-gray-400"></textarea>
                <button type="submit" class="bg-white border-none text-blue-500 ml-5">{{ __('POST') }}</button>
            </div>
        </form>
    </div>
</div>
