@extends('layouts.app')
@section('content')

<main class="row mt-5">
    <section class="user-card col-md-4">
        <div class="card text-bg-light mb-3 bg-info">
            <div class="card-header fs-auto pb-3">
                <h3>{{ $user->name }}</h3>
            </div>
            <div class="card-body">
             <div class="d-flex justify-content-center mb-3">
             <img class="mr-2 rounded-circle" src="{{ Gravatar::src($user->email, 150) }}" alt="ユーザのアバター画像">
            </div>
            <div class="d-flex justify-content-center">
            <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-primary">ユーザ情報の編集</a>
            </div>
        </div>

        </div>
    </section>

    <section class="col-md-8">
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
                    <img class="mr-2 rounded-circle" src="{{ Gravatar::src($user->email, 50) }}" alt="ユーザのアバター画像">
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