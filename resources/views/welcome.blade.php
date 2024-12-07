@extends('layouts.app')
@section('content')
@include('commons.flash_message')
@yield('scripts')
{{-- <div class="center jumbotron bg-info">
        <div class="text-center text-white mt-2 pt-1">
            <h1><i class="pr-3"></i>Topic Posts</h1>
        </div>
</div> --}}
@if (Auth::check())
<div class="container-fluid">
    <div class="row d-flex justify-content-between">
        @include('commons.left_sidebar')

        <!-- メインコンテンツ -->
        <div class="col-6 px-4">
            <div class="d-flex justify-content-center align-items-center">
                <div class="card w-100 shadow-sm">
                    <!-- カードのヘッダー -->
                    <div class="card-header bg-light text-dark text-center">
                        <h5 class="mb-0 fw-bold">"○○"について140字以内で会話しよう！</h5>
                    </div>
        
                    <!-- カードのボディ -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('post.store') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <textarea 
                                    class="form-control rounded-3 shadow-sm" 
                                    name="content" 
                                    rows="3" 
                                    placeholder="ここに投稿内容を入力..."></textarea>
                            </div>
                            <div class="d-flex btn-gradient">
                                <button type="submit" class="btn  w-100 px-4 py-1 mb-0 shadow-sm text-white">Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @include('posts.posts',['posts' => $posts, 'users' => $users])
        </div>

        <!-- 右のサイドバー -->
        <div class="col-3">
            <div class="card shadow-sm mr-3" style="position: sticky; top: 0;">
                <div class="card-header bg-light text-dark text-left">
                    <h5 class="m-0 p-0">Search</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('search.index') }}">
                        <div class="form-group mb-3">
                            <input type="text" name="keyword" class="form-control" placeholder="キーワードで検索" value="{{ request('keyword') }}">
                        </div>
                        <button type="submit" class="btn btn-secondary w-100">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
   .btn-gradient {
    background: linear-gradient(45deg, #2a0750, #1b50ab);
    border: none;
    font-weight: bold;
    transition: transform 0.3s ease, background 0.3s ease;
}

.btn-gradient:hover {
    background: linear-gradient(45deg, #1b50ab, #2a0750);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transform: scale(1.03);
}
</style>
