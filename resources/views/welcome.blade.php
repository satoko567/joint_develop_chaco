@extends('components.tempLayout')<!--モックアップの共通HTMLファイルに基づき作成-->
@section('content')<!--下記はモックアップのトップページに基づき作成-->
<div class="center jumbotron bg-info">
    <div class="text-center text-white mt-2 pt-1">
        <h1><i class="pr-3"></i>Topic Posts</h1>
    </div>
</div>

<!--下記は最新登録した3つのユーザーをアナウンスする部分-->
<div class="container">
    <div class="row my-0">
        @foreach ($newUsers as $newUser)
        <div class="col-md-12 text-center col p-0">
            <p>
                <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($newUser->email))) }}?s=50&d=identicon" alt="User Avatar" class="rounded-circle mb-0">
                {{ $newUser->nickname }}が新規登録しました👏👏
                {{ $newUser->created_at->format('Y-m-d') }}
            </p>
        </div>
        @endforeach
    </div>
</div>

<h5 class="text-center mb-3">"○○"について140字以内で会話しよう！</h5>

<div class="w-75 m-auto">
    @if (count($errors) > 0)
    <ul class="alert alert-danger" style="max-width: 400px; margin: 0 auto; padding: 10px; border: 1px; margin-bottom: 20px; text-align: left;" role="alert">
        @foreach ($errors->all() as $error)
        <li class="ml-4">{{ $error }}</li>
        @endforeach
    </ul>
    @endif
</div>

<div class="text-center mb-3">
    <form method="" action="" class="d-inline-block w-75">
        <div class="form-group">
            <textarea class="form-control" name="" rows="5" placeholder="何でも話そう"></textarea>
            <div class="text-left mt-3">
                <button type="submit" class="btn btn-primary">投稿する</button>
            </div>
        </div>
    </form>
</div>

<!--下記は仮内容後日削除-->
@php
$factors = [];

foreach ($users as $user) {
    $factors[] = [
        'nickname' => $user->nickname,
        'comment' => $user->comment . "{$user->nickname}です！　よろしく！",
        'email' => $user->email, // Gravatar 用
    ];
}
@endphp

@foreach($factors as $factor)
<div class="text-center mb-4">
    <div class="profile-container d-inline-block w-75">
        <div class="profile-image mb-3">
            <h3 class="username">
                <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($factor['email']))) }}?s=50&d=identicon"
                    alt="User Avatar" class="rounded-circle">
                {{ $factor['nickname'] }}
            </h3>
        </div>
        <div class="profile-info">
            <p class="comment">{{ $factor['comment'] }}</p>
        </div>
    </div>
</div>
@endforeach


{{ $users->links('pagination::bootstrap-4') }}
<!--上記は仮内容後日削除-->

@endsection