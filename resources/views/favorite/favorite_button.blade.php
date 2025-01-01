@if (Auth::check() && Auth::id() !== $post->user_id)
    @if (Auth::user()->isFavorite($post->id))
        <form method="POST" action="{{ route('unfavorite', $post->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" button class="btn btn-sm mt-2 btn-danger">👍を外す</button>
        </form>
    @else
        <form method="POST" action="{{ route('favorite', $post->id) }}">
            @csrf
            <button type="submit" button class="btn btn-sm mt-2 btn-primary">👍</button>
        </form>
    @endif
@endif