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

    {{-- ログインしていると、投稿フォームが表示される。してないと表示されない。 --}}
    @if (Auth::check())
        @include('posts.new_post_form')
    @endif

@endsection