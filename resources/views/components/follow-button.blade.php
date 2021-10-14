<form method="POST" action="{{ route('follows.store', $user) }}">
    @csrf
    <button type="submit" class="btn btn-primary ml-2" style="border-radius: 1.25rem">
        {{ auth()->user()->isFollowing($user) ? 'Unfollow me' : 'Follow me' }}
    </button>
</form>