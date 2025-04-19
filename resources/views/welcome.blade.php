@extends('layouts.app')
@section('content')
<div class="center">
    <img class="w-50 mb-3 mx-auto d-block" src="{{ asset('images/top.png') }}" alt="トップ画像">
</div>
<!--検索フォームここに追加 -->
<form action="{{ route('posts.search') }}" method="GET" class="w-50 mx-auto mb-4">
    <input type="text" name="keyword" class="form-control" placeholder="投稿を検索" value="{{ request('keyword') }}">
    <button type="submit" class="btn btn-primary btn-sm mt-2">検索</button>
</form>
<h5 class="text-center mb-1">あなたの好きなまんがについて140字以内で会話しよう！</h5>
@if(auth()->check())
    @include('posts.add_post')
@endif
<div class="mb-4 d-flex justify-content-end">
    <a href="{{ route('ranking.index') }}" class="btn btn-warning">👍 いいねランキングを見る</a>
</div>
@include('posts.posts', ['posts' => $posts])
@endsection