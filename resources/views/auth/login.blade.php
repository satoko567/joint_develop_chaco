@extends('layouts.app')
@section('title', 'ログイン | 修理どこがいい？クルマの名医ナビ')
@section('meta_description', 'クルマ修理レビューアプリへのログインページ。口コミで信頼できる整備工場を見つけましょう。')
@section('content')
    <div class="text-center my-4">
        <h1><i class="fas fa-wrench fa-lg pr-2"></i>クルマの名医ナビ</h1>
    </div>
    <div class="text-center mt-3">
        <p class="text-left d-inline-block mt-3">
            ログインすると、投稿やレビューで<br>
            おすすめの整備工場をシェアできます！
        </p>
    </div>
    <div class="text-center">
        <h3 class="login_title text-left d-inline-block mt-5">ログイン</h3>
    </div>
    <div class="row mt-5 mb-5">
        <div class="col-sm-6 offset-sm-3">
            @include('commons.error_messages')
            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}">
                </div>
                <button type="submit" class="btn btn-primary mt-2">ログイン</button>
            </form>
            <div class="mt-2"><a href="{{ route('register') }}">新規登録はこちら</a></div>
        </div>
    </div>
@endsection