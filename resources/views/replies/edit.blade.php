@extends('layouts.app')

@section('content')
    <h2 class="mb-4">リプライの編集</h2>

    {{-- エラー表示 --}}
    @include('components.flash_message')
    <form method="POST" action="{{ route('replies.update', [$postId, $reply->id]) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <textarea name="content" class="form-control" rows="4">{{ old('content', $reply->content) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">更新する</button>
    </form>
@endsection