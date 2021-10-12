@extends('layouts.app')

@section('content')
    Profile page for {{ $user->name }}

    @include('_timeline', ['tweets' => $user->tweets])
@endsection
