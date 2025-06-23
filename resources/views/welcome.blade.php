@extends('layouts.app')
@section('content')
    {{-- ▼ container の外にヒーロー画像を出すため、直接ここで閉じてから再開 --}}
    </div> {{-- ← layouts.app で開いている .container を一時閉じる --}}

    <div style="
        position: relative;
        background: url('{{ asset('images/hero.png') }}') no-repeat center center;
        background-size: cover;
        aspect-ratio: 16 / 9;   /* 高さを自然に決める */
        width: 100%;
        margin-bottom: 2rem;
        overflow: hidden;">

        {{-- 白のオーバーレイ --}}
        <div style="
            position: absolute;
            inset: 0;
            background-color: rgba(255, 255, 255, 0.6);  /* 白半透明 */
            z-index: 1;">
        </div>

        {{-- タイトル --}}
        <div style="
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            text-align: center;
            width: 100%;">
            <h1 class="text-center" style="
                font-size: clamp(2rem, 6vw, 5rem);
                font-weight: 500;
                color: #17A2B8;
                text-shadow:
                    -2px -2px 2px rgba(0, 0, 0, 0.9),
                    4px 4px 7px rgba(255, 255, 255, 0.9);
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 90%;
                margin: 0 auto;">
                <i class="fas fa-chalkboard-teacher pr-2"></i>寺子屋＠プログラミング
            </h1>
        </div>
    </div>
    <div class="container"> {{-- ← 再開 --}}
        <h5 class="description text-center mb-3">"プログラミング"について140字以内で会話しよう！</h5>
        <form method="GET" action="{{ route('post.index') }}" class="mx-auto mt-4 w-100" style="max-width: 500px;">
        <div class="form-group ">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" placeholder="検索"  value="{{ old('keyword', $keyword) }}" autocomplete="on">
                <div class="input-group-append">
                    <button type="submit" class="btn" style="background-color: #17A2B8; color: white;">検索</button>
                </div>
            </div>
        </div>
        </form>

        {{-- タグ一覧 --}}
        <div class="mb-4 text-center">
            <div class="d-inline-flex flex-wrap justify-content-center">
                @foreach ($tags as $tag)
                    <a href="{{ route('tags.search', ['id' => $tag->id]) }}"
                    class="btn btn-info m-2 px-2 py-0"
                    style="border: 1px solid #17A2B8; color: #17A2B8; border-radius: 20px; background-color: white; font-size: 14px;">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        </div>

        @if (Auth::check())
            <div class="w-75 m-auto">@include('commons.error_messages')</div> 
            <div class="text-center mb-3">
                @include('posts.form')
            </div>
        @endif
        @include('posts.posts', ['posts' => $posts]) 
    </div>
@endsection