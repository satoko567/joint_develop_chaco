@extends('layouts.app')
@section('content')
    <div class="center jumbotron bg-info">
            <div class="text-center text-white mt-2 pt-1">
                <h1><i class="fab fa-telegram fa-lg pr-3"></i>Topic Posts</h1>
            </div>
        </div>
        <!--検索フォームここに追加 -->
         <form action="{{ route('posts.search') }}" method="GET" class="w-50 mx-auto mb-4">
         <input type="text" name="keyword" class="form-control" placeholder="投稿を検索" value="{{ request('keyword') }}">
          <button type="submit" class="btn btn-primary btn-sm mt-2">検索</button>
        </form>
        <h5 class="text-center mb-3">"○○"について140字以内で会話しよう！</h5>
            @if(auth()->check())
                @include('posts.add_post')
            @endif
        <div class="text-center mb-4">
        <a href="{{ route('ranking.index') }}" class="btn btn-warning">👍 いいねランキングを見る</a>
        </div>
    @include('posts.posts', ['posts' => $posts])
@endsection