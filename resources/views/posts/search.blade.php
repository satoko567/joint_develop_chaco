@extends('layouts.app')

@section('content')
    <div class="center jumbotron bg-secondary text-white text-center mb-4">
        <h2><i class="fas fa-search mr-2"></i>検索結果</h2>
        <p>「<strong>{{ $keyword }}</strong>」の検索結果を表示しています</p>
    </div>

    <!-- 🔍 検索フォーム（再検索・ページネーション対応） -->
    <form action="/posts/search" method="GET" class="w-50 mx-auto mb-4">
        <input type="text" name="keyword" class="form-control" placeholder="投稿を検索" value="{{ request('keyword') }}">
        <button type="submit" class="btn btn-primary btn-sm mt-2">検索</button>
    </form>

    @if ($posts->isEmpty())
        <p class="text-center">該当する投稿はありませんでした。</p>
    @else
        @include('posts.posts', ['posts' => $posts])
    @endif

    <div class="text-center mt-4">
        <a href="{{ url('/') }}" class="btn btn-outline-primary">トップに戻る</a>
    </div>
@endsection
