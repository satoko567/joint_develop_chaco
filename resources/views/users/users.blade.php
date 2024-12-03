@if (count($users) > 0)
<ul class="list-unstyled">
    @foreach ($users as $user)
        <li class="mb-3 text-center">
            <div class="text-left d-inline-block w-75 mb-2">
                <img class="mr-2 rounded-circle" src="{{ Gravatar::src($user->email, 55) }}" alt="ユーザのアバター画像">
                <p class="mt-3 mb-0 d-inline-block"><a href="{{ route('users.show', $user_id) }}">{{ $user->name }}</a></p>
            </div>
        </li>
    @endforeach
</ul>
<div class="m-auto" style="width: fit-content">
{{ $posts->appends(['search' => request()->input('search', '')])->links('pagination::bootstrap-4') }}
</div>
@else
    <p>ユーザーが見つかりません。</p>
@endif