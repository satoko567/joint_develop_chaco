<header class="mb-5">
    <nav class="navbar navbar-expand-sm navbar-dark bg-info p-1">
        <a class="navbar-brand pl-3" href="/">Topic Posts</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav align-items-center">
                @if (Auth::check())
                    {{-- <li class="nav-item"><a href="{{ route('user.show', Auth::id()) }}" class="nav-link text-light">{{ Auth::user()->name }}</a></li> --}}
                    @if(Auth::user()->avatar)
                        <li>
                            <a href="{{ route('user.show', Auth::id()) }}" class="nav-link text-light">
                                <img class="rounded-circle img-fluid mr-2" src="{{ Storage::url(Auth::user()->avatar) }}" alt="プロフィール画像" style="width: 50px; height: 50px;">
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('user.show', Auth::id()) }}" class="nav-link text-light">
                                <img class="rounded-circle img-fluid mr-2" src="{{ Gravatar::src(Auth::user()->email, 40) }}" alt="アバター画像">
                            </a>
                        </li>
                    @endif
                     {{-- <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link text-light pr-3">ログアウト</a></li> --}}
                @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link text-light">ログイン</a></li>
                    <li class="nav-item"><a href="{{ route('signup') }}" class="nav-link text-light">新規ユーザ登録</a></li>
                @endif
            </ul>
        </div>
    </nav>
</header>
