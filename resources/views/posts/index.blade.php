@extends('layout')

@section('content')
<div class="row">
    <div class="col-8">

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
    </div>
    <div class="col-4">
        <div class="container">
            <div class="row">
                <div class="card" style="width:100%;">
                        <div class="card-body">
                            <h5 class="card-title">Most Commented</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Some popular comments.</h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($most_commented as $post)
                            <li class="list-group-item">
                                <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
            </div>
            <div class="row mt-4">
                <div class="card" style="width:100%;">
                        <div class="card-body">
                            <h5 class="card-title">Most Active</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Some most active users.</h6>
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
            <div class="row mt-4">
                <div class="card" style="width:100%;">
                        <div class="card-body">
                            <h5 class="card-title">Most Active users in last month</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Some crazy users.</h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($mostActiveLastMonth as $user)
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
