@extends('layouts.app')
@section('content')
<div class="center">
    <img class="w-50 mb-5 mx-auto d-block" src="{{ asset('images/admin_top.png') }}" alt="トップ画像">
</div>

<form method="GET" action="{{ route('admin.show.replies') }}" class="mb-4 d-flex gap-2 flex-wrap align-items-end">
    <div>
        <label for="keyword" class="form-label">検索（ユーザー名・元投稿・リプライ内容）</label>
        <input type="text" name="keyword" id="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="キーワードを入力">
    </div>
    <div>
        <button type="submit" class="btn btn-primary mx-2">検索</button>
        <a href="{{ route('admin.show.replies') }}" class="btn btn-secondary">リセット</a>
    </div>
</form>

<div class="list-group">
    @foreach($posts as $post)
        @php
            $postReplies = $replies->where('post_id', $post->id);
        @endphp

        @if ($postReplies->isNotEmpty())
        <div class="mb-5 border rounded p-4 bg-light shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <small class="text-muted">{{ $post->created_at->format('Y-m-d H:i') }}</small>
                    <strong class="mx-2">{{ $post->user->name }}</strong>
                </div>
            </div>

            <div class="d-flex gap-4 align-items-start mb-3">
                <div class="flex-shrink-0">
                    @if ($post->image_path)
                        <img src="{{ asset('storage/' . $post->image_path) }}"
                            class="img-thumbnail clickable-image"
                            style="width: 150px; height: auto; cursor: pointer;"
                            alt="投稿画像"
                            data-image="{{ asset('storage/' . $post->image_path) }}">
                    @else
                        <img src="{{ asset('images/top.png') }}"
                            class="img-thumbnail clickable-image"
                            style="width: 150px; height: auto; cursor: pointer;"
                            alt="デフォルト画像"
                            data-image="{{ asset('images/top.png') }}">
                    @endif
                </div>

                <div class="flex-grow-1 mx-2">
                    <h5 class="mb-0">{{ $post->content }}</h5>
                </div>
            </div>

            @foreach ($postReplies as $reply)
            <div class="mb-3 p-3 border rounded bg-white shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <div>
                        <small class="text-muted">{{ $reply->created_at->format('Y-m-d H:i') }}</small>
                        <span class="fw-bold mx-2">{{ $reply->user->name }}</span>
                    </div>
                </div>
                <p class="mb-2">{{ $reply->content }}</p>

                <form method="POST" action="{{ route('admin.replies.destroy', $reply->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </div>
            @endforeach
        </div>
        @endif
    @endforeach
</div>

<div class="m-auto mt-4" style="width: fit-content">
    {{ $replies->appends(['keyword' => request()->query('keyword', '')])->links() }}
</div>
@endsection

@include('posts.image_modal')