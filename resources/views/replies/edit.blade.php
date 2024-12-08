@extends('layouts.app')
@section('content')
    <h2 class="mt-5">返信を編集する</h2>
    @include('commons.error_messages')
    <form method="POST" action="{{ route('reply.update', $reply->id) }}">
    @csrf
    @method('PUT')
        <div class="form-group">
            <textarea id="reply" class="form-control" name="content" rows="5">{{ old('content', $reply->content) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">返信を更新する</button>
    </form>
@endsection