@extends('layouts.app')
@section('content')
    <div class="w-100 position-relative" style="margin-top: -15px;">
        <form method="GET" action="{{ url('/') }}" class="d-block d-md-block position-absolute" style="right: 1px; width: 200px; z-index: 10;">
            <label for="keyword" class="sr-only">投稿の検索</label>
            <div class="input-group input-group-sm">
                <input id="keyword" type="text" name="keyword" class="form-control" placeholder="投稿の検索" value="{{ old('keyword', $keyword ?? '') }}" style="border-radius: 0.25rem 0 0 0.25rem;">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" style="border-color: #ced4da; background-color: #f8f9fa; border-radius: 0 0.25rem 0.25rem 0;">
                        🔍
                    </button>
                </div>
            </div>
        </form>
        <div style="height: 45px;"></div>
    </div>
    <div class="center jumbotron bg-info">
        <div class="text-center text-white mt-2 pt-1">
            <h1><i class="pr-3"></i>Topic Posts</h1>
        </div>
    </div>
    <h5 class="text-center mb-3">"○○"について140字以内で会話しよう！</h5>
    <div class="w-75 mx-auto mb-2 text-left">
        @include('commons.error_messages')
    </div>
    @if (Auth::check())
        <div class="text-center mb-3">
            <form method="POST" action="{{ route('posts.store') }}" class="d-inline-block w-75">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name="content" rows="4" placeholder="140字以内で投稿">{{ old('content') }}</textarea>
                    <div class="text-left mt-3">
                        <button type="submit" class="btn btn-primary">投稿する</button>
                    </div>
                </div>
            </form>
        </div>
    @endif
@include('posts.posts',['posts' => $posts, 'keyword' => $keyword])
@endsection 
