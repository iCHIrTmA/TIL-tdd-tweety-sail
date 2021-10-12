<div class="card" style="border: 2px solid #b4b4fb; border-radius: 1.25rem;">
    <div class="card-body">
        <form method="POST" action="{{ route('tweets.store') }}">
            @csrf
            <div class="form-group">
                <textarea name="body" class="form-control" style="border: 1px solid white" rows="3" placeholder="What's up Doc?"></textarea>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <img src="{{ asset('images/default-avatar.jpg') }}" 
                alt=""
                    class="rounded-circle"
                    style="max-width: 5%; height: fit-content;"
                >
                <button type="submit" class="btn btn-primary">Tweet-a-roo</button>
            </div>
        </form>
        @error('body')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>