@extends('layouts.app')

@section('title', $post->title)
@section('content')
    <h1>
        {{ $post->title }}

        <x-badge type="primary" show="now()->diffInMinutes($post->created_at) < 30">
            Brand new Post!
        </x-badge>
    </h1>

    <p>{{ $post->content }}</p>
    {{--  <p class="text-muted">
        Added {{ $post->created_at->diffForHumans() }}
        by {{ $post->user->name }}
    </p>  --}}

    <x-updated date="{{ $post->created_at->diffForHumans() }}" name="{{ $post->user->name }}">
    </x-updated>

    <x-updated date="{{ $post->updated_at->diffForHumans() }}">
        Updated
    </x-updated>

    <h4>Comments</h4>

@forelse ($post->comments as $comment )
    <p>
        {{ $comment->content }}
    </p>
    {{--  <p class="text-muted">
        Added {{ $comment->created_at->diffForHumans() }}
    </p>  --}}
    <x-updated date="{{ $comment->created_at->diffForHumans() }}">
    </x-updated>

@empty
    <p>No comments yet!</p>
@endforelse
@endsection