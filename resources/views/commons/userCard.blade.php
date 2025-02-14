<aside class="col-sm-4 mb-5">
        <div class="card bg-info">
            <div class="card-header">
                <h3 class="card-title text-light">{{ $user->nickname }} さんのプロフィール</h3>
                @include('follow.followButton')
            </div>
            <form action="{{ route('user.uploadIcon') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="icon">ユーザーアイコンのアップロード</label>
                    <input type="file" name="icon" id="icon" class="form-control" accept="image/*">
                </div>
                    <button type="submit" class="btn btn-primary">アップロード</button>
            </form>
                @if(Auth::check())
                    <img src="{{ asset('storage/icons/'.$user->icon) }}" alt="ユーザーアイコン" class="rounded-circle img-fluid" width="65">
                @else
                    <img class="mr-2 rounded-circle" src="{{ Gravatar::src($user->email, 55) }}" alt="ユーザのアバター画像">
                @endif 
                @if(Auth::check()) 
                    <div class="mt-3">
                        <!-- ユーザー情報の編集ボタン -->
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-block">ユーザ情報の編集</a>
                    </div>
                @endif
        </div>
    </aside>