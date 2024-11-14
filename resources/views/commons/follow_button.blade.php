@if (auth()->check() && Auth::id() !== $user->id)
    @if (auth()->user()->isFollowing($user->id))
        <form action="{{ route('unfollow', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-primary bg-light" type="submit">Unfollow</button>
        </form>
    @else
        <form action="{{ route('follow', $user->id) }}" method="POST">
            @csrf
            <button class="btn btn-primary" type="submit">Follow</button>
        </form>
    @endif
@endif