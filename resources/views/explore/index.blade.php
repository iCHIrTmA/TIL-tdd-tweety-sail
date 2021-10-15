<x-app>
    <h3 class="font-weight-bold mb-3">Hi {{ current_user()->username }}, Explore the Tweety World!</h3>
    @foreach ($users as $user)
        <div class="card">
            <div class="card-body d-flex">
                <div>
                <a href="{{ route('profiles.show', $user) }}">
                    <img src="{{ $user->avatar }}"
                    alt="{{ $user->name }}"
                    width="60px"
                    class="mr-2 rounded-circle" 
                    >
                
                </div>

                <div>
                    <h4 class="font-weight-bold mt-3"> {{ '@' . $user->username }}</h4>
                </div>
            </a>
            </div>
        </div>
    @endforeach
    <div class="mt-3">
        {{ $users->links() }}
    </div>
</x-app>