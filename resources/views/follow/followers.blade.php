<div class="container" style="direction: rtl;">

    <div class="row justify-content-center" style="row-gap: 20px; margin-bottom: 20px;">

        @foreach($followers as $index => $user)
        <div class="col-md-2 text-center d-flex flex-column align-items-center">

            <img src="{{ Gravatar::src($user->email, 55) }}" alt="ユーザのアバター画像" class="rounded-circle mb-2">

            <p class="mb-0">
                <a href="{{ route('users.show', $user->id) }}">{{ $user->nickname }}</a>
            </p>

            <p class="mb-1" style="color: white;">
                <span class="badge badge-pill badge bg-info">
                    Post数 {{ totalCount($user)['totalPosts'] }}
                </span>
            </p>

            @include('follow.followButton')
         
        </div>

        @if (($index + 1) % 5 == 0)
    </div>
    <div class="row justify-content-center" style="row-gap: 20px; margin-bottom: 20px;">
        @endif
        @endforeach

    </div>
</div>