@extends('layout')

@section('content')
    <h3>{{ $post->title }}</h3>
    <p>{{ $post->content }} </p>

    <p>Added {{ $post->created_at->diffForHumans() }}</p>
    <h4>Comments</h4>
    @forelse ($post->comments as $comment)
        <p>
            {{ $comment->content }}
        </p>
        <p class="text-muted">
                added {{ $comment->created_at->diffForHumans() }}
        </p>
    @empty
        <p>No Comments Yet!</p>
    @endforelse
@endsection