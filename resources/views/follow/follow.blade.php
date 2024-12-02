<!-- ログインしている場合かつログインしているユーザーのIDでない場合 -->
@if (Auth::check() && Auth::id() !== $user->id)
    <!-- 既にフォローしている場合 -->
    @if (Auth::user()->isFollow($user->id))
        <form method="POST" action="{{ route('unfollow', $user->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">フォロー －</button>
        </form>
    @else
        <form method="POST" action="{{ route('tofollow', $user->id) }}">
            @csrf
            <button type="submit" class="btn btn-primary">フォロー ＋</button>
        </form>
    @endif
@endif