@extends('layouts.app')
@section('content')
    <h2 class="mt-5">投稿を編集する</h2>
    <form method="POST" action="{{ route('post.update', $post->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group mt-5">
         <textarea id="content" class="form-control" name="content" rows=""></textarea> 
        </div>
        <button type="submit" class="btn btn-primary mt-5 mb-5">更新する</button>
        </div>
    </form>
    <h2 class="mt-5">あなたの登録済み投稿</h2>
    @include('posts.posts', ['posts' => $posts])
@endsection