@extends('layouts.app')
@section('content')
    {{-- ▼ container の外にヒーロー画像を出すため、直接ここで閉じてから再開 --}}
    </div> {{-- ← layouts.app で開いている .container を一時閉じる --}}

    {{-- ヒーロー画像 --}}
    <div style="
        position: relative;
        background-image: url('{{ asset('images/hero2.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        width: 100%;
        height: 60vh;
        min-height: 300px;
        margin-bottom: 2rem;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;">

        <div class="hero-overlay"></div>

        <div>
            <h1 class="hero-title">
                <i class="fas fa-chalkboard-teacher pr-2"></i>寺子屋＠プログラミング
            </h1>
        </div>
    </div>
    
    <div class="container"> {{-- ← 再開 --}}
        <h5 class="description text-center mb-3">"プログラミング"について140字以内で会話しよう！</h5>
        <form method="GET" action="{{ route('post.index') }}" class="mx-auto mt-4 px-3" style="max-width: 500px;">
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
            <div class="text-center mb-3">
                @include('posts.form')
            </div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @include('posts.posts', ['posts' => $posts])
                </div>
                <div class="col-md-4"> 
                    @include('users.follower_ranking', ['rankingUsers' => $rankingUsers])
                </div>
            </div>
        </div>
    </div>
@endsection