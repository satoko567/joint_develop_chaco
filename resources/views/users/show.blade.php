@extends('layouts.app')
@section('content')
<div class="row">
    <aside class="col-sm-4 mb-5">
        <div class="card bg-info">
            <div class="card-header">
                <h3 class="card-title text-light">{{ $user->nickname }} さんのプロフィール</h3>
            </div>
            <div class="card-body">
            <img class="rounded-circle img-fluid" src="{{ Gravatar::src($user->email, 300) }}" alt="{{ $user->nickname }}">
                <div class="mt-3">
                    <!-- ユーザー情報の編集ボタン -->
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-block">ユーザ情報の編集</a>
                </div>
            </div>
        </div>
    </aside>
    <div class="col-sm-8">
        <!-- ナビゲーションタブ -->
        <ul class="nav nav-tabs nav-justified mb-3">
            <li class="nav-item">
                <a href="{{ route('users.show', $user->id) }}" class="nav-link {{ Request::is('users/'.$user->id) ? 'active' : '' }}">タイムライン</a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">フォロー中</a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">フォロワー</a>
            </li>
        </ul>
    </div>
   <!-- ユーザーの投稿を表示 -->
@include('posts.post', ['user' => $user]) 
</div>
@endsection