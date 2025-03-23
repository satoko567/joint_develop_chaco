@if ($user->followers->isEmpty())
    <p class="text-muted">フォロワーがいません</p>
@else
    <ul>
        @foreach ($user->followers as $follow)
            <li>{{ $follow->name }}</li>
        @endforeach
    </ul>
@endif