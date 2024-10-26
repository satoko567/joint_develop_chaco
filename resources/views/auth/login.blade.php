<!DOCTYPE html>
<html lang="ja">
        <head>
            <meta charset="utf-8">
            <title>Topic Posts</title>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        </head>
    <body>
        {{-- @extends('layout.app') --}}
        {{-- @section('content') --}}
            <div class="text-center">
                <h1><i class="fab fa-telegram fa-lg pr-3"></i>Topic Posts</h1>
            </div>
            <div class="text-center mt-3">
                <p class="text-left d-inline-block">ログインすると投稿で<br>コミュニケーションができるようになります。</p>
            </div>
            <div class="text-center">
                <h3 class="login_title text-left d-inline-block mt-5">ログイン</h3>
            </div>
            <div class="row mt-5 mb-5">
                <div class="col-sm-6 offset-sm-3">
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
                    <div class="mt-2"><a href="">新規ユーザ登録する？</a></div>
                </div>
            </div>
        {{-- @endsection --}}
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>
