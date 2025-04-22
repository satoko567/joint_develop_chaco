<header class="mb-5">
    <nav class="navbar navbar-expand-sm navbar-dark bg-secondary">
        <a class="navbar-brand" href="/">まんがまとめ</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">

                @if (Auth::check())

                    <!-- 管理者権限があるユーザがログイン中のみ表示 -->
                    @if(Auth::user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link text-light" href="/admin">管理者画面</a>
                        </li>
                    @endif

                    <!-- ログイン中（ユーザー名表示 & ログアウトボタン） -->
                    <li class="nav-item">
                        <a href="{{ route('user.show', Auth::user()->id) }}" class="nav-link text-light">{{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link text-light">ログアウト</a></li>

                @else
                    <!-- ログアウト中（ログイン & 新規登録） -->
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link text-light">ログイン</a></li>
                    <li class="nav-item"><a href="{{ route('signup') }}" class="nav-link text-light">新規ユーザ登録</a></li>
                @endif
            </ul>
        </div>
    </nav>
</header>
