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

    {{-- 検索バー --}}
    <form action="{{ route('posts.search') }}" method="GET" class="form-inline mb-3 justify-content-center">
        <input type="text" name="q" value="{{ old('q', $keyword ?? '') }}" class="form-control mr-2" placeholder="投稿を検索">
        <button type="submit" class="btn btn-outline-primary">検索</button>
    </form>

    {{-- ログインしていると、投稿フォームが表示される。してないと表示されない。 --}}
    @if (Auth::check())
        @include('posts.new_post_form')
    @endif

    @if(isset($keyword))
        <p class="text-muted text-center">「{{ $keyword }}」の検索結果</p>
    @endif

    {{-- 投稿一覧 --}}
    @include ('posts.post', ['posts' => $posts])
@endsection