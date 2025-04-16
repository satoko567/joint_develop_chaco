@extends('layouts.app')

@section('content')
<div class="container">
    <h2>リプライの編集</h2>

    <form method="POST" action="{{ route('replies.update', $reply->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <textarea name="content" class="form-control" rows="3">{{ old('content', $reply->content) }}</textarea>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">更新する</button>
        <a href="{{ route('replies.index', $reply->post_id) }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection
