@extends('layouts.app')
@section('content')
@include('commons.error_messages')
    <h2 class="mt-5">投稿を編集する</h2>
    <form method="POST" action="{{ route('post.update', $post->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group mt-5">
            <textarea id="content" class="form-control" name="content" rows="5">{{ $post->content }}</textarea> 
        </div>
        <button type="submit" class="btn btn-primary mt-5 mb-5">更新する</button>
    </form>
@endsection