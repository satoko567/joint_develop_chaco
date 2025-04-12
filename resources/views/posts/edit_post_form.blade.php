@extends('layouts.app')
@section('content')
{{-- バリデーションエラーの表示 --}}
@include('commons.error_messages')

{{-- 投稿編集フォーム --}}
<div class="text-center mt-3 mb-3">
    <form method="POST" action="{{route('posts.update', $post->id)}}"> {{-- 投稿のIDを取得、posts.updateへ渡す。更新する投稿データを取得させる --}}
        @csrf
        @method('PUT')
        <h2 class="description text-center">投稿を編集する</h2>
        <div class="form-group">
            <textarea type="content" class="form-control custom-textarea" name="content" rows="4">{{$post->content}}</textarea>
            <div class="text-left mt-3">
                <button type="submit" class="btn btn-primary mt-2">更新する</button>
            </div>
        </div>
    </form>
</div>
@endsection