@extends('layouts.app')
@section('content')
<div class="center jumbotron bg-info">
    <div class="text-center text-white mt-2 pt-1">
        <h1>
            <i class="fab fa-telegram fa-lg pr-3"></i>Topic Posts
        </h1>
    </div>
</div>
<h5 class="description text-center">"○○"について140文字以内で会話しよう！</h5>

{{-- バリデーションエラーの表示 --}}
@include('commons.error_messages')

{{-- 投稿フォーム --}}
<div class="text-center mt-3 mb-3">
        <form method="POST" action="{{route('post.store')}}">
            @csrf
            <div class="form-group">
                <textarea type="content" class="form-control custom-textarea" name="content" rows="4" value="{{old('content')}}"></textarea>
                <div class="text-left mt-3">
                    <button type="submit" class="btn btn-primary mt-2">投稿する</button>
                </div>
            </div>
        </form>
</div>
@endsection