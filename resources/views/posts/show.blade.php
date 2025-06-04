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
                @php
                    $defaultImage = config('constants.no_image_path');
                    $imageUrl = $post->image
                        ? asset('storage/' . $post->image)
                        : asset($defaultImage);
                @endphp
                <img src="{{ $imageUrl }}"
                    class="img-fluid rounded mb-3 d-block mx-auto"
                    style="max-height: 400px; object-fit: contain; background-color: #f8f9fa;"
                    alt="投稿画像">
            </div>
            @include('commons.error_messages')
            @if (Auth::check() && Auth::id() !== $post->user_id)
                @if ($hasReplied)
                    <p class="text-muted">※あなたはこの投稿にすでにリプライしています</p>
                @endif
                <form action="{{ route('replies.store', $post->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="reply_body">リプライ内容</label>
                        <textarea name="reply_body" id="reply_body" class="form-control" rows="3">{{ old('reply_body') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">リプライする</button>
                </form>
            @elseif (Auth::check() && Auth::id() === $post->user_id)
                <p class="text-muted">※自分の投稿にはリプライできません。</p>
            @else
                <p class="text-muted">※リプライするにはログインが必要です。</p>
            @endif
            <hr>
            <h5>リプライ一覧（{{ $countReplies }} 件）</h5>
            @if ($replies->isEmpty())
                <p class="text-muted">まだリプライはありません。</p>
            @else
                @foreach ($replies as $reply)
                    <div
                        class="card mb-3 {{ $latestReply && $reply->id === $latestReply->id ? 'border border-info' : '' }}"
                        @if ($latestReply && $reply->id === $latestReply->id)
                            style="background-color: #f0fafd;"
                        @endif
                    >
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>
                                    {{ $reply->user->name }}
                                    @if ($latestReply && $reply->id === $latestReply->id)
                                        <span class="badge border border-info text-info ms-2">最新</span>
                                    @endif
                                </strong>
                                <small class="text-muted">{{ $reply->created_at }}</small>
                            </div>
                            <p class="mt-2 mb-2">{{ $reply->content }}</p>
                            @if (Auth::check() && Auth::id() === $reply->user_id)
                                <div class="text-end">
                                    <a href="{{ route('replies.edit', ['post_id' => $post->id, 'reply_id' => $reply->id]) }}" class="btn btn-sm btn-outline-primary me-1">編集</a>
                                    <form action="{{ route('replies.delete', ['reply_id' => $reply->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="m-auto" style="width: fit-content">
    {{ $replies->links('pagination::bootstrap-4') }}
    </div>
@endsection