@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="w-75 mx-auto">
            <div class="mb-4 b-3">
                <h4>{{ $post->user->name }} さんの投稿</h4>
                <div class="alert alert-info">
                    <strong>投稿内容：<br>
                    {{ $post->content }}<br>
                    </strong>
                    <small class="text-muted">{{ $post->created_at }}</small>
                </div>
                @include('commons.error_messages')
                <h5 class="mt-4">リプライ内容を編集する</h5>
                <form action="{{ route('replies.update', [$post->id, $reply->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <textarea name="reply_body" id="reply_body" class="form-control" rows="3">{{ old('reply_body', $reply->content) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">更新する</button>
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-secondary mt-2">キャンセル</a>
                </form>
            </div>
        </div>
    </div>
@endsection