<ul class="list-unstyled">
    @foreach ($users as $user)
        <li class="mb-5 text-center">
            <div class="text-left d-inline-block w-75 mb-2">
                <img class="mr-2 mb-2 rounded-circle" src="{{ Gravatar::src($user->email, 55) }}" alt="ユーザのアバター画像">
                <p class="mt-3 mb-0 d-inline-block"><a href="{{ route('user.show', $user->id) }}">{{ $user->name }}</a></p>
                @include('follow.follow')
            </div>
        </li>
    @endforeach
</ul>
<div class="m-auto" style="width: fit-content">
{{ $users->links('pagination::bootstrap-4') }}
</div>