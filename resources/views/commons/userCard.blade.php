<aside class="col-sm-4 mb-5">
        <div class="card bg-info">
            <div class="card-header">
                <h3 class="card-title text-light">{{ $user->nickname }} さんのプロフィール</h3>
                @include('follow.followButton')
            </div>
            <div class="card-body">
                <img class="rounded-circle img-fluid" src="{{ Gravatar::src($user->email, 300) }}" alt="{{ $user->nickname }}">
                @if(Auth::check()) 
                    <div class="mt-3">
                        <!-- ユーザー情報の編集ボタン -->
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-block">ユーザ情報の編集</a>
                    </div>
                @endif
            </div>
        </div>
    </aside>