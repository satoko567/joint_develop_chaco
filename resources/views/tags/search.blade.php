@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mt-4 mb-4">#{{ $tag->name }} の投稿</h2>

    @if ($posts->isEmpty())
        <p class="text-center text-muted">このタグにはまだ投稿がありません。</p>
    @else
        <div class="mx-auto" style="max-width: 700px;">
            @include('posts.posts', ['posts' => $posts])
        </div>
    @endif
</div>
@endsection