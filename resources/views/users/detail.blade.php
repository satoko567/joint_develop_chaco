@extends('layouts.app')
@section('content')

<main class="row mt-5">
    <section class="user-card col-sm-4">
        <div class="card text-bg-light mb-3 bg-info">
            <div class="card-header fs-auto pb-3">
                <h3>{{ $user->name }}</h3>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center mb-3">
                    <!-- userのアイコンが設定されていなければ既存の画像を表示 -->
                    <!-- アイコン登録処理はユーザー編集、更新処理開発時に合わせて実施 -->
                    @if($user->icon)
                    <img src="{{ asset('profile_img/' . $user->icon) }}" alt="User Icon" class="rounded-circle" width="150" height="150">
                    @else
                    <i class="bi bi-github" style="font-size: 900%"></i>
                    @endif
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-primary ">ユーザ情報の編集</button>
                </div>
            </div>
        </div>
    </section>

    <section class="col-sm-8">
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="true" href="#">タイムライン</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">フォロー中</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">フォロワー</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <!-- user post作成後 extends -->
                <!-- 応急処置として対象ユーザの投稿(post)を表示する処理を実施 -->
                @if($posts->count() > 0)
                @foreach($posts as $post)
                <div class="post mb-4 mx-4">
                    <div class="d-flex justify-content-start align-items-center">
                        @if($user->icon)
                        <img src="{{ asset('profile_img/' . $user->icon) }}" alt="User Icon" class="rounded-circle" width="50" height="50">
                        @else
                        <i class="bi bi-github" style="font-size:300%"></i>
                        @endif
                        <a class="mx-2" href="">{{ $user->name }}</a>
                    </div>
                    <p class="card-text d-flex justify-content-start">{{ $post->content }}</p>
                    <small class="text-muted d-flex justify-content-start">投稿日: {{ $post->created_at->format('Y-m-d H:i:s') }}</small>
                </div>
                @endforeach

                <div class="d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>
                @else
                <p>投稿はまだありません。</p>
                @endif
            </div>
        </div>
    </section>
</main>

@endsection