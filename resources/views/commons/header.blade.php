<header class="mb-5">
    <nav class="navbar navbar-expand-sm navbar-dark bg-info">
        <a class="navbar-brand" href="/">Topic Posts</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    <li class="nav-item"><a href="{{ route('top') }}" class="nav-link">ログアウト</a></li>  {{-- routeのアドレス'top'はダミーで書いた。後にログインルートネームに変更する必要がある。Rikoさんへ連絡。 --}}
                    <li class="nav-item"><a href="{{ route('users.show' , Auth::id()) }}" class = "nav-link">ユーザー：<span class="user-name">{{ Auth::user()->name }}</span></a></li>
                @else
                    <li class="nav-item"><a href="{{ route('top') }}" class="nav-link">ログイン</a></li>  {{-- routeのアドレス'top'はダミーで書いた。後にログインルートネームに変更する必要がある。Rikoさんへ連絡。 --}}
                    <li class="nav-item"><a href="{{ route('signup') }}" class="nav-link">新規ユーザ登録</a></li>
                @endif
            </ul>
        </div>
    </nav>
</header>
