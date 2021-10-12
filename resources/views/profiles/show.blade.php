@extends('layouts.app')

@section('content')
    Profile page for {{ $user->name }}

    <div class="card mt-4" style="border: 1px solid #d9d2d2; border-radius: 1.25rem;">
        @foreach($user->tweets as $tweet)
            @include('_tweet')
        @endforeach
    </div>
@endsection
