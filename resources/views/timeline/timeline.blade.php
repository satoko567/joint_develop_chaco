<div class="container">
    @foreach($activities as $activity)
    @if(isset($activity->content))
    <!-- 投稿の場合 -->
    <div class="card mb-3">
        <div class="card-header">
            <img src="{{ Gravatar::src($activity->user->email, 50) }}" alt="ユーザのアバター画像" class="mr-2 rounded-circle">
            <a href="{{ route('users.show', $activity->user->id) }}">
                {{ $activity->user->nickname }}
            </a>
            が
            @if (!is_null($activity->parent_id) && $activity->post)
            <a href="{{ route('posts.comment', $activity->post->id) }}" class="text-primary">
                コメント
            </a>
            に返信をしました。
            @elseif (!is_null($activity->post_id) && $activity->post)
            <a href="{{ route('posts.comment', $activity->post->id) }}" class="text-primary">
                ポスト
            </a>
            にコメントをしました。
            @elseif ($activity->post)
            <a href="{{ route('posts.comment', $activity->post->id) }}" class="text-primary">
                ポスト
            </a>
            を投稿しました。
            @endif

            <span class="float-right">{{ $activity->created_at }}</span>
        </div>
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="d-flex flex-column">
                @if ($activity->parent_id)
                <div class="border p-2 rounded bg-light">
                    <p class="mb-2">{!! nl2br(e($activity->parent->content)) !!}</p>
                </div>
                <div class="mt-2">
                    <p class="mb-2">　⇧　{!! nl2br(e($activity->content)) !!}</p>
                </div>
                @else
                <div class="mt-2">
                    <p class="mb-2">{!! nl2br(e($activity->content)) !!}</p>
                </div>
                @endif
            </div>

            @if(Auth::check() && Auth::user()->id === $activity->user_id)
            @if(isset($activity->post_id))
            <div class="d-flex">
                <form method="POST" action="{{ route('comment.destroy', $activity->id ) }}" class="me-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="mr-1 btn btn-danger">削除</button>
                </form>
                <a href="{{route('comment.edit', $activity->id)}}" class="btn btn-primary">編集する</a>
            </div>
            @else
            <div class="d-flex">
                <form method="POST" action="{{ route('posts.destroy', $activity->id ) }}" class="me-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="mr-1 btn btn-danger">削除</button>
                </form>
                <a href="{{route('post.edit', $activity->id)}}" class="btn btn-primary">編集する</a>
            </div>
            @endif
            @endif
        </div>
    </div>
    @else
    <!-- フォローの場合 -->
    <div class="alert alert-info">

        <img src="{{ Gravatar::src($user->email, 50) }}" alt="ユーザのアバター画像" class="mr-2 rounded-circle">
        <a href="{{ route('users.show', $user->id) }}">
            {{ $user->nickname }}
        </a>
        が
        <img src="{{ Gravatar::src($activity->email, 50) }}" alt="ユーザのアバター画像" class="mr-2 ml-2 rounded-circle">
        <a href="{{ route('users.show', $activity->id) }}">
            {{ $activity->nickname }}
        </a>
        をフォローしました。
        <span class="float-right">{{ $activity->pivot->created_at }}</span>
    </div>
    @endif
    @endforeach

    <!-- ページネーションリンク -->
    {{ $activities->links() }}
</div>