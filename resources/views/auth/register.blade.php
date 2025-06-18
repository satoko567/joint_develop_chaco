@extends('layouts.app')
@section('content')
    <div class="text-center">
        <h1 class="d-flex align-items-center justify-content-center fs-3 fw-bold mb-4">
            <i class="fab fa-telegram mr-3" style="font-size: 2.4rem;"></i> Topic Post
        </h1>
        <div class="mx-auto mb-5" style="max-width: 400px; text-align: left; padding-left: 2rem;">
            <p class="fs-6">
                新規ユーザ登録すると投稿で<br>
                コミュニケーションができるようになります。
            </p>
        </div>
        <div class="row mt-4 mb-5 justify-content-center">
            <div class="col-sm-6 text-left">
                <h2 class="text-center mt-3" style="font-size: 1.75rem; margin-bottom: 3.5rem;">新規ユーザ登録</h2>
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
    </div>
@endsection