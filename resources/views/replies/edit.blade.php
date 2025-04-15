@extends('layouts.app')

@section('content')
<div class="container">
    <h2>リプライの編集</h2>

    {{-- エラーメッセージ --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('replies.update', $reply->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <textarea name="content" class="form-control" rows="3">{{ old('content', $reply->content) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">更新する</button>
        <a href="{{ route('replies.index', $reply->post_id) }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection
