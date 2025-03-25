@if ($user->following->isEmpty())
    <p class="text-muted">フォローしているユーザーがいません</p>
@else
    <ul>
        @foreach ($user->following as $follow)
            <li class="d-flex justify-content-start my-4">
                <img class="mr-2 rounded-circle" src="{{ Gravatar::src($follow->email, 50) }}" alt="ユーザのアバター画像">
                <a class="mx-3" href="{{ route('user.show', ['id' => $follow->id]) }}">{{ $follow->name }}</a>
            </li>
        @endforeach
    </ul>
@endif