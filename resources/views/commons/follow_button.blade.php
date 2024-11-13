@if (Auth::id() !== $user->id)
    @if (auth()->user()->following()->where('followed_id', $user->id)->exists())
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