<div class="text-center">
  <h1>
    <i class="fab fa-telegram fa-lg pe-3" aria-hidden="true"></i>
    Topic Posts
  </h1>
  <p class="mt-3">新規ユーザ登録すると投稿で<br>コミュニケーションができるようになります。</p>
</div>

<div class="row mt-5 mb-5 justify-content-center">
  <div class="col-sm-6">
    <h2 class="login_title mb-4">新規ユーザ登録</h2>
    <form method="POST" action="{{ route('register') }}">
      @csrf
            @if (count($errors) > 0)
                <ul class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        <li class="ml-4">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
      <div class="mb-3">
        <label for="name" class="form-label">名前</label>
        <input id="name" name="name" type="text" class="form-control"
               value="{{ old('name') }}" required autofocus>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">メールアドレス</label>
        <input id="email" name="email" type="email" class="form-control"
               value="{{ old('email') }}" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">パスワード</label>
        <input id="password" name="password" type="password" class="form-control"
               required minlength="8">
      </div>

      <div class="mb-3">
        <label for="password_confirmation" class="form-label">パスワード確認</label>
        <input id="password_confirmation" name="password_confirmation"
               type="password" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">新規登録</button>
    </form>
  </div>
</div>