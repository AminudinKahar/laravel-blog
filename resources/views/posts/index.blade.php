@extends('layouts.app')

@section('title', 'Blog Posts')
@section('content')
<div class="row">
    <div class="col-8">
        {{--  @each('posts.partials.post', $posts, 'post')  --}}
        @forelse($posts as $key => $post)
        @include('posts.partials.post', [])
        @empty
        No posts found!
        @endforelse
    </div>
    <div class="col-4">
        <div class="container">
            {{--  most commented blog posts  --}}
            <div class="row">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                      <h5 class="card-title">Most Commented</h5>
                      <h6 class="card-text text-muted">
                          What people are currently talking about
                        </h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($mostCommented as $post)
                            <li class="list-group-item">
                                <a href="{{ route('posts.show', ['post' =>$post->id]) }}">
                                    {{ $post->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{--  active user with most post written  --}}
            <div class="row mt-4">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                      <h5 class="card-title">Most Active</h5>
                      <h6 class="card-text text-muted">
                          Users with most posts written
                        </h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($mostActive as $user)
                            <li class="list-group-item">
                                    {{ $user->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
        </div>
        
    </div>
    
</div>
@endsection