@extends('layouts.app')
@section('title', '新規登録 | クルマの名医ナビ')
@section('meta_description', 'クルマ修理レビューアプリへの新規登録ページ。投稿やレビューでおすすめの整備工場をシェアしよう。')
@section('content')
    <div class="text-center my-4">
        <h1><i class="fas fa-wrench fa-lg pr-2"></i>クルマの名医ナビ</h1>
    </div>
    <div class="text-center mt-3">
        <p class="text-left d-inline-block mt-3">
            新規登録すると、投稿やレビューで<br>
            おすすめの整備工場をシェアできます！
        </p>
    </div>
    <div class="row mt-4 mb-5 justify-content-center">
        <div class="col-sm-6 text-left">
            <h2 class="text-center mt-3" style="font-size: 1.75rem; margin-bottom: 3.5rem;">新規登録</h2>
            @include('commons.error_messages')
            <form method="POST" action="{{ route('signup.post') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">名前</label>
                    <input id="name" name="name" type="text" class="form-control" value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">メールアドレス</label>
                    <input id="email" name="email" type="text" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">パスワード</label>
                    <input id="password" name="password" type="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">パスワード確認</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary mt-2">新規登録</button>
            </form>
            <div class="mt-2">
                <a href="{{ route('login') }}">ログインはこちら</a>
            </div>
        </div>
    </div>
@endsection