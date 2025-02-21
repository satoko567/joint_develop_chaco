@extends('layouts.app')
@section('content')
@include('commons.error_messages')
<div class="container mt-5">
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-info text-white">
            <h3 class="mb-0">トピック</h3>
        </div>
        <div class="card-body">
            <img src="{{ Gravatar::src($post->user->email, 50) }}" alt="ユーザのアバター画像" class="mr-2 rounded-circle">
            <a href="{{ route('users.show', $post->user->id) }}">
                {{ $post->user->nickname }}
            </a>
            <h2 class="card-title">{{ $post->title }}</h2>
            <p class="lead">{!! nl2br(e($post->content)) !!}</p>
        </div>
    </div>

    <h3>コメントを投稿</h3>
    <hr>
    <form action="{{ route('comments.store', $post->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="content" class="form-label">コメント</label>
            <textarea name="content" id="content" class="form-control" rows="3" placeholder="○○について140字以内で会話しよう！" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">投稿する</button>
    </form>
    <hr>

    <h3>コメント一覧</h3>
    @if ($comments->isNotEmpty())
    <ul class="list-group">
        @foreach ($comments as $comment)
        @if (!$comment->parent_id) {{-- 親コメントのみを表示 --}}
        @include('posts.commentPartial', ['comment' => $comment])
        @endif
        @endforeach
    </ul>
    <div class="mt-3">
        {{ $comments->links() }}
    </div>
    @else
    <p>まだコメントがありません。</p>
    @endif
    <hr>
</div>

@endsection