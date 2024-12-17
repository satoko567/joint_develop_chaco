<div class="col-3 pl-5">
    <div class="card shadow-sm mx-0 border-secondary" style="position: sticky; top: 20px;">
        <div class="card-body ps-3">
            <ul class="list-group list-group-flush borderless-list">
                <!-- プロフィール -->
                <li class="list-group-item">
                    @if(Auth::check())
                        <a href="{{ route('user.show', Auth::id()) }}" class="text-decoration-none text-dark">
                    @endif
                            <i class="fas fa-user mr-2"></i> プロフィール
                        </a>
                    </li>
                <!-- ブックマーク -->
                <li class="list-group-item">
                    @if(Auth::check())
                        <a href="/bookmarks" class="text-decoration-none text-dark">
                    @endif
                            <i class="fas fa-bookmark mr-2"></i> ブックマーク
                        </a>
                </li>
                <!-- 設定 -->
                <li class="list-group-item">
                    @if(Auth::check())
                        <a href="/settings" class="text-decoration-none text-dark">
                    @endif
                            <i class="fas fa-cog mr-2"></i> 設定
                        </a>
                </li>
                <!-- ログアウト -->
                @if (Auth::check())
                    <li class="list-group-item">
                        <a href="{{ route('logout') }}" class="text-decoration-none text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>

<style>
.borderless-list .list-group-item {
    border: none;
    padding: 10px 15px;
    transition: background-color 0.3s ease;
}

.borderless-list .list-group-item:hover {
    background-color: #f1f1f1;
}
</style>