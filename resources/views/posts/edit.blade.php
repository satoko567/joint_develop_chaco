@extends('layouts.app')
@section('content')
<div class="container w-50">
    <h2 class="mt-5">投稿を編集する</h2>
    {{-- Error Messages --}}
    @include('commons.error_messages')
    <form method="POST" action="{{ route('post.update', $post->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <textarea id="content" class="form-control" name="content" rows="5" >{{ old('content') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">更新する</button>
    </form>
</div>
@endsection