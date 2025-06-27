<header class="mb-3">
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <a class="navbar-brand" href="/">クルマの名医ナビ</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav-bar">
      <ul class="navbar-nav mr-auto"></ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="{{ route('about.show') }}" class="nav-link text-light">運営者紹介</a>
        </li>
        @if (Auth::check())
          <li class="nav-item">
            <a href="{{ route('posts.create') }}" class="nav-link text-light">投稿する</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('user.show', Auth::id()) }}" class="nav-link text-light">{{ Auth::user()->name }}</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link text-light">ログアウト</a>
          </li>
        @else
          <li class="nav-item">
            <a href="{{ route('login') }}" class="nav-link text-light">ログイン</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('signup') }}" class="nav-link text-light">新規登録</a>
          </li>
        @endif
      </ul>
    </div>
  </nav>
</header>