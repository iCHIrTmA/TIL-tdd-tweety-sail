<x-app>
<!-- TODO: FIX mobile view -->
<header class="mb-6 position-relative">
    <div class="position-relative">
        <img src="{{ asset('images/default-profile-banner.jpg') }}" alt="" style="width:45.5rem">
        <img src="{{ $user->avatar }}" 
        alt=""
        class="rounded-circle position-absolute"
        style="width: 10rem; height: fit-content; top:150px; left: calc(50% - 6rem)"
    >
    </div>
    
    <div class="d-flex justify-content-between align-items-center">
        <div class="pt-2">
            <h1 class="font-weight-bold mb-0"> {{ $user->name }}</h1>
            <p class="mb-0"> {{ $user->created_at->diffForHumans() }}</p>
        </div>
        <div class="d-flex">
            @can('edit', $user)
                <a href="{{ route('profiles.edit', $user)}}" class="btn btn-outline-secondary" style="border-radius: 1.25rem">Edit Profile</a>
            @endcan
            <x-follow-button :user="$user"></x-follow-button>
        </div>
    </div>

    <p class="mt-3">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Nunc massa lacus, fermentum et dui gravida, ultricies ultrices turpis.
        Vestibulum in tellus accumsan, porta risus ut, accumsan nisl.
        Phasellus dignissim libero neque, at facilisis leo congue sit amet.
        Morbi volutpat sodales ligula et ornare. Phasellus consequat quis dui vel ultricies.
        Quisque vestibulum cursus enim, luctus hendrerit massa consequat vitae. Etiam porttitor sodales cursus.
    </p>
</header>

@include('_timeline', ['tweets' => $user->tweets])
</x-app>
