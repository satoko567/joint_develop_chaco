@extends('layouts.app')
@section('content')
<!-- 投稿詳細 -->
<ul class="list-unstyled">
    <li class="mb-3 text-center">
        <div class="text-left d-inline-block w-75 mb-2">
            <img class="mr-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 55) }}" alt="ユーザのアバター画像">
            <p class="mt-3 mb-0 d-inline-block">
                <a href="{{ route('user.show', $post->user->id) }}">{{ $post->user->name }}</a>
            </p>
        </div>
        <div class="text-left d-inline-block w-75">
            <p class="mb-2">{{ $post->content }}</p>
            <p class="text-muted">{{ $post->created_at }}</p>
        </div>
    </li>
</ul>

<!-- コメント一覧 -->
<h5>コメント一覧</h5>
        @foreach($post->comments as $comment)
        <ul class="list-unstyled">
            <li class="mb-3 text-center">
                <div class="text-left d-inline-block w-75 mb-2">
                    <img class="mr-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 55) }}" alt="ユーザのアバター画像">
                    <p class="mt-3 mb-0 d-inline-block">
                        <a href="{{ route('user.show', $post->user->id) }}">{{ $comment->user->name }}</a>
                    </p>
                </div>
                <div class="text-left d-inline-block w-75">
                    <p class="mb-2">{{ $comment->body }}</p>
                    <p class="text-muted">{{ $comment->created_at }}</p>
                </div>
            </li>
        </ul>
        @endforeach

        <!-- コメント投稿フォーム -->
        <form action="{{ route('comments.store', $post->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <textarea name="body" class="form-control" rows="4" placeholder="コメントを入力"></textarea>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary">コメントする</button>
            </div>
        </form>
        <a href="{{ url('/') }}" class="btn btn-secondary mt-3">トップページへ戻る</a>
    </div>
@endsection
