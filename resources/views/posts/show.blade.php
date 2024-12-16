@extends('layouts.app')
@section('content')
<!-- 投稿詳細 -->
<div class="container w-50">
    <ul class="list-unstyled">
        <li class="mb-2">
            <div class="card mx-auto shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img class="mr-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 55) }}" alt="ユーザのアバター画像">
                        <div>
                            <a href="{{ route('user.show', $post->user->id) }}" class="text-decoration-none">
                                <strong>{{ $post->user->name }}</strong>
                            </a>
                            <p class="text-muted small mb-0">{{ $post->created_at->format('Y/m/d H:i') }}</p>
                        </div>
                    </div>
                    <p class="mb-2">{{ $post->content }}</p>

                     <!-- コメント投稿フォーム -->
                    @auth
                    {{-- Error Messages --}}
                    @include('commons.error_messages')
                        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="m-0 p-0">
                            @csrf
                            <div class="d-flex align-items-center flex-wrap">
                                <div class="form-group flex-grow-1 mb-0">
                                    <textarea name="body" class="form-control" rows="1" placeholder="コメントを入力"></textarea>
                                </div>
                                <div class="mt-md-0 ms-md-3">
                                    <button type="submit" class="btn btn-primary ml-1">コメントする</button>
                                </div>
                            </div>
                        </form>
                    @endauth
                </div>
            </div>
        </li>
    </ul>

   
<!-- コメント一覧 -->
    <h5 class="mt-4 text-left">コメント一覧</h5>
<!-- コメント一覧 -->
    <ul class="list-unstyled mt-2">
        @foreach($post->comments as $comment)
            <li class="mb-0">
                <div class="card mx-auto">
                    <div class="card-body">
                        <!-- ユーザー情報 -->
                        <div class="d-flex align-items-center mb-3">
                            @if($comment->user->avatar)
                                <img class="rounded-circle mr-2" src="{{ Storage::url($comment->user->avatar) }}" alt="現在のプロフィール画像" style="width: 45px; height: 45px;">
                            @else
                                <img class="rounded-circle mr-2" src="{{ Gravatar::src($comment->user->email) }}" alt="ユーザのアバター画像" style="width: 45px; height: 45px;">
                            @endif
                            <div>
                                <a href="{{ route('user.show', $comment->user->id) }}" class="text-decoration-none">
                                    <strong>{{ $comment->user->name }}</strong>
                                </a>
                                <p class="text-muted small mb-0">{{ $comment->created_at->format('Y/m/d H:i') }}</p>
                            </div>
                        </div>
                        <!-- コメント本文 -->
                        <p class="m-0">{{ $comment->body }}</p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <!-- トップページへ戻るボタン -->
    <div class="text-center mt-4">
        <a href="{{ url('/') }}" class="btn btn-secondary">トップページへ戻る</a>
    </div>
</div>
@endsection
