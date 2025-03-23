@if ($user->following->isEmpty())
    <p class="text-muted">フォローしているユーザーがいません</p>
@else
    <ul>
        @foreach ($user->following as $follow)
            <li>{{ $follow->name }}</li>
        @endforeach
    </ul>
@endif