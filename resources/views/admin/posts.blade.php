@extends('layouts.app')
@section('content')
<div class="center">
    <img class="w-50 mb-5 mx-auto d-block" src="{{ asset('images/admin_top.png') }}" alt="トップ画像">
</div>

<form method="GET" action="{{ route('admin.show.posts') }}" class="mb-4 d-flex gap-2 flex-wrap align-items-end">
    <div>
        <label for="keyword" class="form-label">検索（ユーザー名・投稿内容）</label>
        <input type="text" name="keyword" id="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="キーワードを入力">
    </div>
    <div>
        <button type="submit" class="btn btn-primary mx-2">検索</button>
        <a href="{{ route('admin.show.posts') }}" class="btn btn-secondary">リセット</a>
    </div>
</form>

<div class="list-group">
    @foreach($users as $user)
        @php
            $userPosts = $posts->where('user_id', $user->id);
        @endphp

        @if ($userPosts->isNotEmpty())
        <div class="mb-5 border rounded p-4 bg-light shadow-sm">
            <h5 class="mb-3 fw-bold">{{ $user->name }}</h5>

            @foreach($userPosts as $post)
            <div class="mb-4 p-3 border rounded bg-white d-flex flex-column flex-md-row align-items-start gap-3 shadow-sm">
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
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <small class="text-muted">{{ $post->created_at->format('Y-m-d H:i') }}</small>
                    </div>
                    <p class="mb-2">{{ $post->content }}</p>

                    <form method="POST" action="{{ route('admin.posts.destroy', $post->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    @endforeach

    <div class="m-auto" style="width: fit-content">
        {{ $posts->appends(request()->query())->links() }}
    </div>
</div>
@endsection

@include('posts.image_modal')