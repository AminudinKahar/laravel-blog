{{--  @break($key == 2)  --}}
{{--  @continue($key == 1)  --}}

<h3>
    @if ($post->trashed())
        <del>
    @endif  
        <a class="{{ $post->trashed() ? 'text-muted' : '' }}"
            href="{{ route('posts.show', ['post'=> $post->id]) }}">{{ $post->title}}</a>
    </del>
</h3>

{{--  <p class="text-muted">
    Added {{ $post->created_at->diffForHumans() }}
    by {{ $post->user->name }}
</p>  --}}

<x-updated date="{{ $post->created_at->diffForHumans() }}" name="{{ $post->user->name }}">
</x-updated>

@if($post->comments_count)
    <p>{{ $post->comments_count }} comments</p>
@else
    <p>No comments yet!</p>
@endif

<div class="mb-3">
    @auth
        @can('update',$post)
            <a href="{{ route('posts.edit', ['post'=> $post->id]) }}"class="btn btn-primary">Edit</a>
        @endcan
    
    {{--  @cannot('delete',$post)
        <p>You can't delete this post</p>
    @endcannot  --}}
    
        @if (!$post->trashed())
            @can('delete',$post)
                <form class="d-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete!" class="btn btn-primary">
                </form>   
            @endcan  
        @endif    
    @endauth

</div>