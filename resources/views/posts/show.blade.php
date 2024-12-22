@extends('layouts.app')
@section('content')
@include('commons.flash_message')
@yield('scripts')
<!-- 投稿詳細 -->
<div class="container w-50">
    <ul class="list-unstyled">
        <li class="mb-2">
            <div class="card mx-auto shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        @if($post->user->avatar)
                            <img class="mr-2 rounded-circle" src="{{ Storage::url($post->user->avatar) }}" alt="プロフィール画像" style="width: 55px; height: 55px;">
                        @else
                            <img class="mr-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 55) }}" alt="アバター画像">
                        @endif
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
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="card-text">{{ $comment->body }}</div>
                            @if (Auth::id() === $comment->user_id)
                                <div>
                                    <div>
                                        <button class="btn btn-link" data-toggle="modal" data-target="#commentModal">
                                                <i class="fas fa-edit icon-ini icon-blue"></i>
                                        </button>
                                        <button type="submit" class="btn btn-link" title="削除" data-toggle="modal" data-target="#deleteConfirmModal">
                                            <i class="fas fa-trash icon-ini icon-red"></i>
                                        </button>
                                    </div>
                                    
                                    <!-- モーダル -->
                                    <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="commentModalLabel">コメント編集</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="閉じる"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('comment.update', $comment->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group mb-3">
                                                            <textarea 
                                                                class="form-control rounded-3 shadow-sm" 
                                                                name="body" 
                                                                rows="3" 
                                                                placeholder="ここに編集内容を入力..."></textarea>
                                                        </div>
                                                            <button type="submit" class="btn btn-primary px-4 py-1 w-100">編集する</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4>確認</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <label>本当にコメントを削除しますか？</label>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-between">
                                                    <form method="POST" action="{{ route('comment.delete', $comment->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">削除する</button>
                                                    </form>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
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

<style>
    .icon-ini{
        color: gray;
        transition: color 0.3s ease;
    }
    
    .icon-red:hover {
        color: red;
        transform: scale(1.2);
        transition: color 0.3s ease, transform 0.3s ease;
    }
    .icon-blue:hover {
        color: blue;
        transform: scale(1.2);
        transition: color 0.3s ease, transform 0.3s ease;
    }
</style>