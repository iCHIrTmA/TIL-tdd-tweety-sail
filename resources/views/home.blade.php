@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm">
            @include('_sidebar-links')
        </div>
        <div class="col-sm-8">
            @include('_publish-tweet')
            @include('_timeline')
        </div>
        <div class="col-sm" style="background-color: #a7bbff; border-radius: 1.25rem;">
            @include('_friends-list')
        </div>
    </div>
@endsection
