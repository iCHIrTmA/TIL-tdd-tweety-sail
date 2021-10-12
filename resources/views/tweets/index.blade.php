@extends('layouts.app')

@section('content')
    @include('_publish-tweet')
    
    <div class="card mt-4" style="border: 1px solid #d9d2d2; border-radius: 1.25rem;">
        @foreach($tweets as $tweet)
            @include('_tweet')
        @endforeach
    </div>
@endsection
