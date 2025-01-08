@extends('layouts.app')
@if ($posts->isEmpty())
    <p>投稿がありません</p>
    @else
    <ul class="list-unstyled">
    @foreach($posts as $post)
        <li class="mb-3 text-center">
            <div class="text-left d-inline-block w-75 mb-2">
            <img class="mr-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 55) }}" alt="ユーザのアバター画像">

                <p class="mt-3 mb-0 d-inline-block"><a href="">{{ $post->user->name }}</a></p>
            </div>
            <div class="">
                <div class="text-left d-inline-block w-75">
                    <p class="mb-2">{{ $post->content }}</p>
                    <p class="text-muted">{{ $post->created_at->format('Y-m-d H:i') }}</p>
                </div>

                
               
                        <div class="d-flex justify-content-between w-75 pb-3 m-auto">
                            <form action="" method="" onsubmit="">
                                <button type="submit" class="btn btn-danger">削除</button>
                            </form>
                            <a href="" class="btn btn-primary">編集する</a>
                        </div>
            </div>

        </li>
    @endforeach
    </ul>
@endif

<div class="m-auto" style="width: fit-content">
{{ $posts->links('pagination::bootstrap-4') }}
</div> 
<!-- ページネーション追加 -->