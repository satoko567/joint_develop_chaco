@extends('layouts.app')
@section('content')
    {{-- ▼ container の外にヒーロー画像を出すため、直接ここで閉じてから再開 --}}
    </div> {{-- ← layouts.app で開いている .container を一時閉じる --}}

    {{-- ▼ 横幅100%のヒーロー画像 + タイトルを中央に重ねる --}}
    <div style="
        background: url('{{ asset('images/hero.png') }}') no-repeat center center;
        background-size: cover;
        height: 80vh;
        width: 100%;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;">
        <div class="text-white text-center" style="
            background-color: rgba(0, 0, 0, 0.5);
            padding: 2rem;
            border-radius: 1rem;">
            <h1 class="display-4 fw-bold">
                <i class="fas fa-chalkboard-teacher pr-2"></i>寺子屋＠プログラミング
            </h1>
        </div>
    </div>
    <div class="container"> {{-- ← 再開 --}}
        <h5 class="description text-center mb-3">"プログラミング"について140字以内で会話しよう！</h5>
        <form method="GET" action="{{ route('post.index') }}" class="mx-auto mt-4" style="width: 500px;">
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