<div class="card mt-4" style="border: 1px solid #d9d2d2; border-radius: 1.25rem;">
    @forelse($tweets as $tweet)
        @include('_tweet')
    @empty
        <p class="p-4">No tweets yet</p>
    @endforelse
</div>