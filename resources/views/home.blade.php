@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm">
            @include('_sidebar-links')
        </div>
        <div class="col-sm-8">
            @include('_publish-tweet')
            <div class="card mt-4" style="border: 1px solid #d9d2d2; border-radius: 1.25rem;">
                @foreach($tweets as $tweet)
                    @include('_tweet')
                @endforeach
            </div>
        </div>
        <div class="col-sm" style="background-color: #a7bbff; border-radius: 1.25rem;">
            @include('_friends-list')
        </div>
    </div>
@endsection
