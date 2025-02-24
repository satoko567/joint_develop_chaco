<div class="container" style="direction: rtl;">

    <div class="row justify-content-center" style="row-gap: 20px; margin-bottom: 20px;">

        @foreach($following as $index => $user)
        <div class="col-md-2 text-center d-flex flex-column align-items-center">

                @if($user->icon && Storage::disk('public')->exists('icons/'. $user->icon)) 
                    <img src="{{ asset('storage/icons/'.$user->icon) }}" alt="ユーザーアイコン" class="rounded-circle img-fluid" width="55">
                @else
                    <img class="mr-2 rounded-circle" src="{{ Gravatar::src($user->email, 55) }}" alt="ユーザのアバター画像">
                @endif 
                
            <p class="mb-0">
                <a href="{{ route('users.show', $user->id) }}">{{ $user->nickname }}</a>
            </p>

            <p class="mb-1 " style="color: white;">
                <span class="badge bg-info ms-2">
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