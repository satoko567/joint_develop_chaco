@extends('layouts.app')

@section('content')
@include('components.flash_message')

{{-- 投稿の表示 --}}
<div class="card mt-3">
  <div class="card-body">
    <h4>{{ $post->user->name }} の投稿</h4>
    <p>{{ $post->content }}</p>
    <p class="text-muted">投稿日: {{ $post->created_at->format('Y年m月d日 H:i') }}</p>
  </div>
</div>

{{-- リプライ一覧 --}}
<h5 class="mt-4">リプライ一覧</h5>
@forelse ($post->replies as $reply)
  <div>{{ $reply->content }}</div>
@empty
  <p class="text-center text-muted mt-4">リプライはまだありません。</p>
@endforelse
@endsection
