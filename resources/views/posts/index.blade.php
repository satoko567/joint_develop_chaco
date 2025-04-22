@extends('layouts.app')
@section('content')
    <div class="center jumbotron bg-info">
        <div class="text-center text-white mt-2 pt-1">
            <h1>
                <i class="fab fa-telegram fa-lg pr-3"></i>
                Topic Posts
            </h1>
        </div>
    </div>
    <h5 class="description text-center">"○○"について140文字以内で会話しよう！</h5>

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