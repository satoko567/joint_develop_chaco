@extends('layouts.app')
@section('content')
    <div class="center jumbotron bg-info">
        <div class="text-center text-white mt-2 pt-1">
            <h1>
                <i class="fa-solid fa-book pr-3"></i>
                学習共有プラットフォーム
            </h1>
        </div>
    </div>
    <h5 class="description text-center">今日の学習内容は？</h5>

    {{-- ログインしていると、投稿フォームが表示される。してないと表示されない。 --}}
    @if (Auth::check())
        @include('posts.new_post_form')
    @endif

        {{-- 検索バー --}}
        {{-- 打ち込まれた内容データは、name="q"で取得できるようにした。 --}}
        <form action="{{ route('posts.search') }}" method="GET" class="form-inline mt-5 mb-3 justify-content-center">
            <input type="text" name="search_content" value="{{ old('search_content', $keyword ?? '') }}" class="form-control mr-2" placeholder="投稿を検索">
            <button type="submit" class="btn btn-outline-primary">検索</button>
        </form>

    @if(isset($keyword))
        <p class="text-muted text-center">「{{ $keyword }}」の検索結果</p>
    @endif

    <hr class="hr1">
    {{-- 投稿一覧 --}}
    @include ('posts.post', ['posts' => $posts])
@endsection