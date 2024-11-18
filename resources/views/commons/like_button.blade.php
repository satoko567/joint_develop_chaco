@if (auth()->check() && $post->isLikedBy(auth()->user()->id))
    <form action="{{ route('posts.unlike', $post->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-link p-0 text-decoration-none">
            <i class="fas fa-heart text-danger"></i>
            <span class="text-danger">{{ $post->likedByUsers->count() }}</span>
        </button>
    </form>
@else
    <form action="{{ route('posts.like', $post->id) }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-link p-0 text-decoration-none">
            <i class="far fa-heart text-muted"></i>
            <span class="text-muted">{{ $post->likedByUsers->count() }}</span>
        </button>
    </form>
@endif