@extends('layouts.app')
@section('content')

<main class="row mt-5">
    <section class="user-card col-md-4">
        <div class="card text-bg-light mb-3 bg-info">
            <div class="card-header fs-auto pb-3 text-white d-flex justify-content-between">
                <h3>{{ $user->name }}</h3>
                @if(auth()->user()->id !== $user->id)
                    @if(auth()->user()->isFollowing($user->id))
                    <form action="{{ route('user.unfollow', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-info rounded-pill border px-4">フォロー中</button>
                    </form>
                    @else
                    <form action="{{ route('user.follow', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-secondary rounded-pill px-3">フォローする</button>
                    </form>
                    @endif
                @endif
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center mb-3">
                    <img class="mr-2 rounded-circle" src="{{ Gravatar::src($user->email, 150) }}" alt="ユーザのアバター画像">
                </div>

                @if(Auth::id() === $user->id)
                <div class="d-flex justify-content-center">
                    <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-primary">ユーザ情報の編集</a>
                </div>

                <!-- 退会ボタン -->
                <div class="d-flex justify-content-center mt-3">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">退会する</button>
                </div>
                @endif

            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">最終確認</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        本当に退会しますか？
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('users.destroy', ['id'=>$user->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">退会する</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- モーダルここまで -->

    </section>

    <section class="col-md-8">
        <div class="card text-center">
            <div class="card-header bg-white">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active bg-white text-primary" id="nav-post-tab" data-bs-toggle="tab" data-bs-target="#nav-post" type="button" role="tab" aria-controls="nav-post" aria-selected="true">タイムライン</button>
                        <button class="nav-link bg-white text-primary" id="nav-follow-tab" data-bs-toggle="tab" data-bs-target="#nav-follow" type="button" role="tab" aria-controls="nav-follow" aria-selected="false">フォロー</button>
                        <button class="nav-link bg-white text-primary" id="nav-follower-tab" data-bs-toggle="tab" data-bs-target="#nav-follower" type="button" role="tab" aria-controls="nav-follower" aria-selected="false">フォロワー</button>
                        <button class="nav-link bg-white text-primary" id="nav-favorite-tab" data-bs-toggle="tab" data-bs-target="#nav-favorite" type="button" role="tab" aria-controls="nav-favorite" aria-selected="false">お気に入り</button>
                    </div>
                </nav>
                <div class="tab-content mt-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-post" role="tabpanel" aria-labelledby="nav-post-tab" tabindex="0"> @include('posts.posts', ['posts' => $posts])</div>
                    <div class="tab-pane fade" id="nav-follow" role="tabpanel" aria-labelledby="nav-follow-tab" tabindex="0"> @include('users.follows.following', ['id' => $user->id])</div>
                    <div class="tab-pane fade" id="nav-follower" role="tabpanel" aria-labelledby="nav-follower-tab" tabindex="0">@include('users.follows.followers', ['id' => $user->id])</div>
                    <div class="tab-pane fade text-secondary" id="nav-favorite" role="tabpanel" aria-labelledby="nav-favorite-tab" tabindex="0">to be continued</div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection


