<div class="container mt-4">
    <div class="list-group">
    @include('commons.error_messages')
        @foreach($comments as $comment)
        <div class="card mb-3">
            <div class="card-header">
                <img src="{{ Gravatar::src($comment->user->email, 50) }}" alt="ユーザのアバター画像" class="mr-2 rounded-circle">
                <a href="{{ route('users.show', $comment->user->id) }}">
                    {{ $comment->user->nickname }}
                </a>
                があなたの
                @if($comment->parent)
                @if($comment->parent->user_id === Auth::user()->id)
                <a href="{{ route('posts.comment', $comment->post->id) }}" class="text-primary">
                    Comment
                </a> に返信をしました。
                @else
                <a href="{{ route('posts.comment', $comment->post->id) }}" class="text-primary">
                    Post
                </a> のCommentに返信をしました。
                @endif
                @else
                <a href="{{ route('posts.comment', $comment->post->id) }}" class="text-primary">
                    Post
                </a> にコメントをしました。
                @endif
                <span class="float-right">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column">
                    @if ($comment->parent_id && $comment->parent)
                    <div class="border p-2 rounded bg-light">
                        <p class="mb-2">{!! nl2br(e($comment->parent->content)) !!}</p>
                    </div>
                    <div class="mt-2">
                        <p class="mb-2">　⇧　{!! nl2br(e($comment->content)) !!}</p>
                    </div>
                    @else
                    <div class="mt-2">
                        <p class="mb-2">{!! nl2br(e($comment->content)) !!}</p>
                    </div>
                    @endif
                </div>
                @if(Auth::check() && in_array(Auth::user()->id, [$comment->post->user_id, $comment->user_id]))
                <div class="d-flex">
                    <form method="POST" action="{{ route('comment.destroy', $comment->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">削除</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-3">{{ $comments->links() }}</div>
</div>