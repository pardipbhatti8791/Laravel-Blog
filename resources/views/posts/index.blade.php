@extends('layout')

@section('content')
@forelse ($posts as $post)
<p>
    <h3>
        <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
    </h3>
    <p class="text-muted">
        added {{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}
    </p>
    @if ($post->comments_count)
    <p>{{ $post->comments_count }} comments</p>
    @else
    <p>No comment yet!</p>
    @endif

    @can('update', $post)
    <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit</a>
    @endcan

    @can('delete', $post)
    <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST" class="fm-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-primary">Delete</button>
    </form>
    @endcan

</p>
@empty
<p>No Blog Post</p>
@endforelse
@endsection