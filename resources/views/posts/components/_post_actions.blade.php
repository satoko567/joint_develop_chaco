<div class="d-flex justify-content-between w-75 pb-3 m-auto">
    @if (Auth::id() === $post->user_id)
        <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">削除</button>
        </form>
        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">編集する</a>
    @endif
</div>
