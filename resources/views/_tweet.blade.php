<div class="card-body">
    <div class="row d-flex align-items-center">
        <img src="{{ asset('images/default-avatar.jpg') }}" 
        alt=""
        class="rounded-circle mx-3"
        style="max-width: 7%; height: fit-content";
        >
        <div>
            <h3 class="mt-3" style="font-size: 1.0rem; font-weight: 700; color:black;">{{ $tweet->owner->name }}</h4>
        </div>
    </div>
    <p class="card-text mt-2" style="font-size: 1.0rem; font-weight: 500; color:black;">
        {{ $tweet->body }}
    </p>
</div>
@unless($loop->last)
    <hr>
@endunless
