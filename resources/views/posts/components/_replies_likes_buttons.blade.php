<a href="{{ route('replies.index', $post->id) }}" class="btn btn-light">💬
    {{ $post->replies->count() }}</a>
<form method="POST" action="{{ route('posts.like', $post->id) }}" style="display:inline;">
    @csrf
    @php
        $liked = $post->isLikedBy(auth()->user());
        $likedUserNames = $post->likes->pluck('user.name')->implode('、'). ' がいいねしました！'; // ユーザー名をカンマ区切りで表示
    @endphp

    <button type="submit" class="btn {{ $liked ? 'btn-success' : 'btn-light' }}" data-bs-toggle="tooltip"
        data-bs-placement="top" title="{{ $likedUserNames }}" @if (Auth::id() === $post->user_id) disabled @endif>
        👍 {{ $post->likes->count() }}
    </button>
</form>