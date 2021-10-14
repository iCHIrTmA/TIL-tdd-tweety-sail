<h3 class="my-4" style="font-size: 1.2rem; font-weight: 700; color:black;">Friends</h3>
<ul class="list-group">
    @forelse(current_user()->follows as $user)
        <li class="list-unstyled mb-2" style="font-size: 1rem; font-weight: 700;">
            <a href="{{ route('profiles.show', $user) }}">
                <img src="{{ $user->avatar }}" 
                alt=""
                class="rounded-circle mr-2"
                style="max-width: 25%"
                >
                {{ $user->name }}
            </a>
        </li>
    @empty
        <li class="list-unstyled mb-2" style="font-size: 1rem; font-weight: 700;">
            No friends yet
        </li>
    @endforelse
</ul>