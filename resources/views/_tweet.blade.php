<div class="card-body">
    <div class="row d-flex flex-row align-items-center justify-content-start">
        <a href="{{ route('profiles.show', $tweet->owner) }}">
            <img src="{{ $tweet->owner->avatar }}" 
            alt=""
            class="rounded-circle mx-3"
            style="max-width: 50px;"
        >
        </a>
        <a href="{{ route('profiles.show', $tweet->owner) }}">
            <h3 class="mt-3" style="font-size: 1.0rem; font-weight: 700; color:black;">{{ $tweet->owner->name }}</h4>
        </a>
     </div>
    <p class="card-text mt-4" style="font-size: 1.0rem; font-weight: 500; color:black;">
        {{ $tweet->body }}
    </p>
</div>
@unless($loop->last)
    <hr>
@endunless
