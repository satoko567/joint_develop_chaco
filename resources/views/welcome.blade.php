@extends('layouts.app')
@section('title', '修理どこがいい？クルマの名医ナビ | 車修理のおすすめ整備工場を口コミで探せる')
@section('meta_description', '信頼できる自動車整備工場を口コミ・レビューで探せる車修理特化アプリ。高評価の整備工場を簡単に検索できる。')
@section('content')
    <div class="bg-dark text-white py-4 mb-3">
        <div class="container text-center">
            <h1 class="display-4 font-weight-bold welcome-custom-title">修理どこがいい？クルマの名医ナビ</h1>
            <p class="lead mt-3">信頼できる自動車整備工場が口コミで見つかる、車修理レビューアプリ</p>
            <div class="mt-4">
                <video controls width="100%" style="max-width: 720px;" class="mx-auto d-block">
                    <source src="{{ asset('videos/sample.mp4') }}" type="video/mp4">
                    お使いのブラウザは video タグをサポートしていません。
                </video>
            </div>
            {{-- 検索フォーム（共通化） --}}
            <form action="{{ route('posts.index') }}" method="GET" class="mt-4 w-75 mx-auto search-form">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i> {{-- 虫眼鏡アイコン --}}
                        </span>
                    </div>
                    <input id="keyword" type="text" name="keyword" class="form-control" placeholder="キーワード or タグ検索" value="{{ old('keyword', $keyword ?? '') }}">
                    <button class="btn btn-primary" type="submit">検索</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <div class="text-center mt-3 welcome-tags">
                    <a href="{{ route('posts.index', ['keyword' => '修理']) }}" class="badge badge-secondary">#修理</a>
                    <a href="{{ route('posts.index', ['keyword' => '車検']) }}" class="badge badge-secondary">#車検</a>
                    <a href="{{ route('posts.index', ['keyword' => '対応が丁寧']) }}" class="badge badge-secondary">#対応が丁寧</a>
                    <a href="{{ route('posts.index', ['keyword' => '価格が安い']) }}" class="badge badge-secondary">#価格が安い</a>
                </div>
            </div>
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
        <a href="{{ route('about.show') }}" class="welcome-button welcome-btn-about welcome-btn-about-last">
            <i class="fas fa-user-circle mr-1"></i> 運営者紹介
        </a>
    </div>
    {{-- エラーメッセージ --}}
    <div class="container mb-3">
        @include('commons.error_messages')
    </div>

    {{-- 新着レビュー --}}
    <div class="container mb-5">
        <div class="text-center mb-3">
            <h3 class="welcome-new-post-title">
                <i class="fas fa-star text-warning mr-2"></i>最新の投稿
            </h3>
            <p class="text-muted mt-2" style="font-size: 0.95rem;">
                信頼されている整備工場の声をチェックしよう！
            </p>
        </div>
    </div>
@include('posts.posts', ['posts' => $posts, 'keyword' => $keyword, 'tag' => $tag ?? null])
@endsection