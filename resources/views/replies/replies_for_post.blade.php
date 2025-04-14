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
    @if (Auth::check())
             <form method="POST" action="{{ route('replies.store', $post->id) }}">
        @csrf
            <div class="mb-3">
                <textarea name="content" class="form-control" rows="2" placeholder="リプライを入力してください">{{ old('content') }}</textarea>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
            <button type="submit" class="btn btn-primary">リプライする</button>
        </form>
    @endif
        <div class="mb-3 mt-2">
        <a href="{{ url('/') }}" class="btn btn-secondary">← トップページに戻る</a>
        </div>
</div>
@endsection
