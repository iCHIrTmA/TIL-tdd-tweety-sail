<div class="flex">
    @if($tweet->isLiked())
        <form method="POST"
            action="{{ route('like.store', [current_user(), $tweet]) }}">
            @csrf
            @method('DELETE')
    @else
        <form method="POST"
            action="{{ route('like.store', [current_user(), $tweet]) }}">
            @csrf
    @endif
        <div class="d-flex align-items-center mr-4"> 
        <button type="submit" class="rounded-cirle" style="border-color: transparent; background: transparent;">
            <img src="{{ asset('/images/like-button.svg') }}" alt="" style="max-width: 20px;">
        </button>
                {{ $tweet->likes->count() ?: 0 }}
        </div>
    </form> 
</div>
