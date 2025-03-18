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
                    <button type="button" class="btn btn-primary ">ユーザ情報の編集</button>
                </div>
            </div>
        </div>

        <!-- 以下退会ボタン（仮設置）※ユーザ編集画面実装後移動 -->
        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">退会する</button>

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
                        <form action="{{ route('user.destroy', ['id'=>$user->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">退会する</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- ここまで退会処理ボタン -->

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