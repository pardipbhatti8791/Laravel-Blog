<p class="text-muted">
        added {{ $post->created_at->diffForHumans() }}
        by
        {{ $post->user->name }}
    </p>
