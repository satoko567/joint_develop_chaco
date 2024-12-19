@extends('layouts.app')
@section('content')
@if($bookmarkedPosts->isEmpty())
    <div class="d-flex justify-content-center align-items-center custom-width">
        <p>ブックマークされた投稿はありません。</p>
    </div>
@else
    <div class="d-flex justify-content-center align-items-center custom-width">
        <h4>{{ $user->name }}のブックマーク一覧</h4>
    </div>
    <div class="mt-4">
        <ul class="list-unstyled">
        @foreach ($bookmarkedPosts as $post)
            <div class="d-flex justify-content-center align-items-center custom-width">
                <li class="card mb-3 shadow-sm dynamic-shadow w-100 border-secondary border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            @if($post->user->avatar)
                                <img class="mr-2 rounded-circle" src="{{ Storage::url($post->user->avatar) }}" alt="現在のプロフィール画像" style="width: 55px; height: 55px;">
                            @else
                                <img class="mr-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 55) }}" alt="ユーザのアバター画像">
                            @endif 
                            <div>
                                <h6 class="mb-0">
                                    <a href="{{ route('user.show', $post->user->id) }}" class="text-decoration-none text-dark">{{ $post->user->name }}</a>
                                </h6>
                                <small class="text-muted">{{ $post->created_at }}</small>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="card-text">{{ $post->content }}</div>
                            @if (Auth::id() === $post->user_id)
                                <div>
                                    <form method="POST" action="" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link icon-ini icon-red" title="削除">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-link icon-ini icon-blue" title="編集">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="d-flex align-items-center mt-3">
                            <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none mr-2">
                                <i class="fas fa-comment text-muted"></i> <!-- 吹き出しアイコン -->
                                <span class="text-muted">{{ $post->comments_count ?? 0 }}</span>
                            </a>
                            @include('commons.like_button') <!--Like Button -->
                            @include('commons.bookmark_button', ['post' => $post]) <!-- Bookmark Button -->
                        </div>
                    </div>
                </li>
            </div>
        @endforeach
        </ul>
        <div class="m-auto" style="width: fit-content">
            {{ $bookmarkedPosts->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endif
@endsection

<style>
.borderless-list .list-group-item {
    border: none;
    padding: 10px 15px;
    transition: background-color 0.3s ease;
}

.borderless-list .list-group-item:hover {
    background-color: #f1f1f1;
}

.custom-width {
    width: 70%;
    margin: 0 auto;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>