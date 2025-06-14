@extends('layouts.app')

@section('content')
@include('components.flash_message')

{{-- 投稿の表示 --}}
<div class="card mt-4 px-4 pt-4 pb-3" style="width: 100%;">
<div class="text-left d-inline-block w-75 mb-2">  
                    <img class="mr-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 55) }}" alt="ユーザのアバター画像">
                    <p class="mt-3 mb-0 d-inline-block"><a href="{{ route('user.show', ['id' => $post->user->id]) }}">{{ $post->user->name }}</a></p>
                </div>
                <div class="">
        <p>{{ $post->content }}</p>
        <p class="text-muted">{{ $post->created_at }}</p>
    </div>
</div>
{{-- リプライ一覧 --}}
<h5 class="mt-4">リプライ一覧</h5>
@forelse ($post->replies as $reply)
    <div class="d-flex align-items-start mb-3">
        {{-- リプライ者のアバター画像 --}}
        <img class="mr-2 rounded-circle" src="{{ Gravatar::src($reply->user->email, 55) }}" alt="ユーザのアバター画像">

        <div>
        {{-- 氏名 --}}
        <div>{{ $reply->user->name }}</div>

        {{-- 本文 --}}
        <div>{{ $reply->content }}</div>

        {{-- 投稿日時 --}}
        <div class="text-muted small">投稿日: {{ $reply->created_at }}</div>
        </div>
    </div>
@empty
    <p class="text-muted mt-4">リプライはまだありません。</p>
@endforelse

@endsection
