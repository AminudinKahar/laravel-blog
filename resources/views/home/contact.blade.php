@extends('layouts.app')

@section('title','Contact Page')
@section('content')

    <h1>Contact Page</h1>
    <p>This is the contact page</p>

    @can('home.secret')
        <a href="{{ route('home.secret') }}">
            Go to special contact details
        </a>
    @endcan

@endsection