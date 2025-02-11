@extends('layouts.app')
@section('content')
<div class="center jumbotron bg-info">
    <div class="text-center text-white mt-2 pt-1">
        <h1><i class="pr-3"></i>Topic Posts</h1>
    </div>
</div>

<h5 class="text-center mb-3">"○○"について140字以内で会話しよう！</h5>

@if(Auth::check())
<div class="text-center mb-3">
    <form method="POST" action="{{ route('posts.store') }}" class="d-inline-block w-75">
        <div class="text-left mt-1">@include('commons.error_messages')</div>
        @csrf
        <div class="form-group">
            <textarea class="form-control" name="content" rows="5" placeholder="共同開発について話してみては？"required oninput="updateCharCount(this)"></textarea>
            <div class="text-left mt-1">
                <small id="charCount" class="text-muted">残り140文字</small>
            </div>
            <div class="text-left mt-3">
                <button type="submit" class="btn btn-primary">投稿する</button>
            </div>
        </div>
    </form>
</div>
@endif

<script>
    function updateCharCount(textarea) {
        const maxLength = 140;
        const currentLength = textarea.value.length;
        const remaining = maxLength - currentLength;
        document.getElementById('charCount').textContent = `残り${remaining}文字`;
    }
</script>

@include('posts.post')

@endsection
