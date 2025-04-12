@extends('layouts.app')

@section('content')
<div class="container">
    <h2>「{{ $post->content }}」へのリプライ一覧</h2>

    {{-- 💬ボタン--}}
    <div class="mb-3">
        <a href="{{ route('replies.index', $post->id) }}">
            💬 {{ $post->replies->count() }}
        </a>
    </div>

    @if ($replies->isEmpty())
        <p>まだリプライはありません。</p>
    @else
        @foreach ($replies as $reply)
            <div class="card mb-2">
                <div class="card-body">
                    <strong>{{ $reply->user->name }}</strong>：{{ $reply->content }}
                    <div class="text-muted small">{{ $reply->created_at->format('Y/m/d H:i') }}</div>
                </div>
            </div>
        @endforeach
        <div class="mt-3">
        {{ $replies->links() }}
        </div>
    @endif
</div>
@endsection
