@extends('layouts.app')
@section('title', '修理どこがいい？クルマの名医ナビ | 車修理のおすすめ整備工場を口コミで探せる')
@section('meta_description', '信頼できる自動車整備工場を口コミ・レビューで探せる車修理特化アプリ。高評価の整備工場を簡単に検索できる。')

@section('content')
<head>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        .custom-title {
            font-family: 'Anton', sans-serif;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
            letter-spacing: 1px;
        }
    </style>
</head>

<body>
<div class="bg-dark text-white py-4 mb-3">
    <div class="container text-center">
        <h1 class="display-4 font-weight-bold custom-title">修理どこがいい？クルマの名医ナビ</h1>
        <p class="lead mt-3">信頼できる自動車整備工場が口コミで見つかる、車修理レビューアプリ</p>
        <div class="mt-4">
            <video controls width="100%" style="max-width: 720px;" class="mx-auto d-block">
                <source src="{{ asset('videos/sample.mp4') }}" type="video/mp4">
                お使いのブラウザは video タグをサポートしていません。
            </video>
        </div>
        {{-- 検索フォーム（共通化） --}}
        <form action="{{ url('/') }}" method="GET" class="mt-4 w-75 mx-auto">
            <div class="input-group">
                <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fas fa-search"></i> {{-- 虫眼鏡アイコン --}}
            </span>
        </div>
                <input id="keyword" type="text" name="keyword" class="form-control" placeholder="キーワード検索" value="{{ old('keyword', $keyword ?? '') }}">
                <button class="btn btn-primary" type="submit">検索</button>
            </div>
        </form>
    </div>
</div>
<div class="welcome-button-group">
    @if(Auth::check())
        <a href="{{ route('posts.create') }}" class="welcome-button welcome-btn-about">
            <i class="fas fa-pen mr-1"></i> 投稿する
        </a>
    @else
        <a href="{{ route('register') }}" class="welcome-button welcome-btn-about">
            <i class="fas fa-user-plus mr-1"></i> 無料登録で投稿
        </a>
    @endif
    <a href="{{ route('about.show') }}" class="welcome-button welcome-btn-about">
        <i class="fas fa-user-circle mr-1"></i> 運営者紹介
    </a>
</div>
{{-- エラーメッセージ --}}
<div class="container mb-3">
    @include('commons.error_messages')
</div>

{{-- 新着レビュー --}}
<div class="container mb-5">
    <h3 class="text-center mb-3">🔧 新着レビュー</h3>              
</div>
<script>
 window.difyChatbotConfig = {
  token: 'bkjw6diZTdu9pzTv',
  systemVariables: {
    // user_id: 'YOU CAN DEFINE USER ID HERE',
    // conversation_id: 'YOU CAN DEFINE CONVERSATION ID HERE, IT MUST BE A VALID UUID',
  },
 }
</script>
<script
 src="https://udify.app/embed.min.js"
 id="bkjw6diZTdu9pzTv"
 defer>
</script>
<style>
  #dify-chatbot-bubble-button {
    background-color: #1C64F2 !important;
  }
  #dify-chatbot-bubble-window {
    width: 24rem !important;
    height: 40rem !important;
  }
</style>

@include('posts.posts',['posts' => $posts, 'keyword' => $keyword])
@endsection