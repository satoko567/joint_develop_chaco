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
    <div class="d-flex justify-content-center align-items-center">
        <div class="card shadow-sm p-4 mb-3 w-50">
                <h5 class="text-center mb-3">"○○"について140字以内で会話しよう！</h5>
                <form method="POST" action="{{ route('post.store') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <textarea 
                            class="form-control rounded-3 shadow-sm" 
                            name="content" 
                            rows="3" 
                            placeholder="ここに投稿内容を入力..."></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-primary w-100 px-4 py-2 shadow-sm">投稿する</button>
                    </div>
                </form>
        </div>
    </div>
    @endif
        <div class="text-center mb-3">
            <form method="GET" action="{{ route('search.index') }}" class="d-inline-block w-75">
                <div class="d-flex justify-content-end">
                    <input type="text" name="keyword" placeholder="キーワードで検索" value="{{ request('keyword') }}">
                    <button type="submit" class="btn btn-secondary">検索</button>
                </div>
            </form>
        </div>
@include('posts.posts',['posts' => $posts, 'users' => $users])
@endsection
