<div class="container">
    @foreach($activities as $activity)
    @if(isset($activity->content))
    <!-- 投稿の場合 -->
    <div class="card mb-3">
        <div class="card-header">
                @if(Auth::check())
                    <img src="{{ asset('storage/icons/'.$user->icon) }}" alt="ユーザーアイコン" class="rounded-circle img-fluid" width="55">
                @else
                    <img class="mr-2 rounded-circle" src="{{ Gravatar::src($user->email, 55) }}" alt="ユーザのアバター画像">
                @endif 
                <a href="{{ route('users.show', $user->id) }}">
                {{ $activity->user->nickname }}
            が投稿をしました。
            <span class="float-right">{{ $activity->created_at }}</span>
        </div>
        <div class="card-body d-flex justify-content-between align-items-center">
            <p class="mb-2">{!! nl2br(e($activity->content)) !!}</p>

            @if(Auth::check() && Auth::user()->id === $activity->user_id)
            <div class="d-flex">
                <form method="" action="" class="me-2">
                    <button type="submit" class="mr-1 btn btn-danger">削除</button>
                </form>
                <a href="{{route('post.edit', $activity->id)}}" class="btn btn-primary">編集する</a>
            </div>
            @endif
        </div>
    </div>
    @else
    <!-- フォローの場合 -->
    <div class="alert alert-info">

                @if(Auth::check())
                    <img src="{{ asset('storage/icons/'.$user->icon) }}" alt="ユーザーアイコン" class="rounded-circle img-fluid" width="55">
                @else
                    <img class="mr-2 rounded-circle" src="{{ Gravatar::src($user->email, 55) }}" alt="ユーザのアバター画像">
                @endif 
                    <a href="{{ route('users.show', $user->id) }}">
            {{ $user->nickname }}
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