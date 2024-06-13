@if (Auth::user()->isFollow($user->id))
    <form method="POST" action="{{ route('unfollow', $user->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">フォロー解除</button>
    </form>
    @if ($user->isFollow(Auth::user()))
    
@else
    <form method="POST" action="{{ route('follow', $user->id) }}">
        @csrf
        <button type="submit" class="btn btn-success">フォロー</button>
    </form>
@endif