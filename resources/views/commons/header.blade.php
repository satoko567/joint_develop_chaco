<header class="mb-5">
    <nav class="navbar navbar-expand-sm navbar-dark bg-info">
        <a class="navbar-brand" href="/">Topic Posts</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
<<<<<<< HEAD
                @if (Auth::check())
                    <li class="nav-item"><a href="" class="nav-link text-light">{{ Auth::user()->name }}</a></li>
                    <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link text-light">ログアウト</a></li>
                @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link text-light">ログイン</a></li>
                    <!-- <li class="nav-item"><a href="{{ route('signup') }}" class="nav-link text-light">新規ユーザ登録</a></li> -->
                @endif
        </div>
    </nav>
</header>
=======
                    <li class="nav-item"><a href="" class="nav-link text-light">ログインユーザ名</a></li>
                    <li class="nav-item"><a href="" class="nav-link text-light">ログアウト</a></li>
                    <li class="nav-item"><a href="" class="nav-link text-light">ログイン</a></li>
                    <li class="nav-item"><a href="" class="nav-link text-light">新規ユーザ登録</a></li>
        </div>
    </nav>
</header>
>>>>>>> 08b01a2e607ffc52f22a4287e4c4f13dc3d2e55f
