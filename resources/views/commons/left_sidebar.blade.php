<div class="col-3 px-3">
    <div class="card shadow-sm ml-3" style="position: sticky; top: 0;">
        <div class="card-header">
            <h5 class="fw-bold mb-0">メニュー</h5>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush borderless-list">
                <!-- ホーム -->
                <li class="list-group-item">
                    <a href="/home" class="text-decoration-none text-dark">
                        <i class="fas fa-home mr-2"></i> ホーム
                    </a>
                </li>
                <!-- エクスプローラー -->
                <li class="list-group-item">
                    <a href="/explore" class="text-decoration-none text-dark">
                        <i class="fas fa-hashtag mr-2"></i> エクスプローラー
                    </a>
                </li>
                <!-- 通知 -->
                <li class="list-group-item">
                    <a href="/notifications" class="text-decoration-none text-dark">
                        <i class="fas fa-bell mr-2"></i> 通知
                    </a>
                </li>
                <!-- メッセージ -->
                <li class="list-group-item">
                    <a href="/messages" class="text-decoration-none text-dark">
                        <i class="fas fa-envelope mr-2"></i> メッセージ
                    </a>
                </li>
                <!-- ブックマーク -->
                <li class="list-group-item">
                    <a href="/bookmarks" class="text-decoration-none text-dark">
                        <i class="fas fa-bookmark mr-2"></i> ブックマーク
                    </a>
                </li>
                <!-- プロフィール -->
                <li class="list-group-item">
                    <a href="/profile" class="text-decoration-none text-dark">
                        <i class="fas fa-user mr-2"></i> プロフィール
                    </a>
                </li>
                <!-- 設定 -->
                <li class="list-group-item">
                    <a href="/settings" class="text-decoration-none text-dark">
                        <i class="fas fa-cog mr-2"></i> 設定
                    </a>
                </li>
            </ul>
            <div>
            <!-- 投稿ボタン -->
            <div class="text-center mt-4">
                <button class="btn btn-primary w-100" data-toggle="modal" data-target="#postModal">
                    <i class="fas fa-pen mr-2"></i> 新しい投稿
                </button>
            </div>
            <!-- モーダル -->
             <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <!-- モーダルヘッダー -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="postModalLabel">新しい投稿</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="閉じる"></button>
                        </div>
                        <!-- モーダルボディ -->
                        <div class="modal-body">
                            <form method="POST" action="{{ route('post.store') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <textarea 
                                        class="form-control rounded-3 shadow-sm" 
                                        name="content" 
                                        rows="3" 
                                        placeholder="ここに投稿内容を入力..."></textarea>
                                </div>
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary px-4 py-1 w-100">投稿する</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>


<style>
.card {
    border-radius: 10px;
     overflow: hidden; 
}

.btn-primary {
    font-weight: bold;
    font-size: 1rem;
}
.borderless-list .list-group-item {
    border: none; /* ボーダーを削除 */
    padding: 10px 15px; /* 適切な余白を維持 */
    transition: background-color 0.3s ease; /* ホバー時の背景変化をスムーズに */
}

.borderless-list .list-group-item:hover {
    background-color: #f1f1f1; /* ホバー時の背景色 */
}

</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('postModal');
    document.body.appendChild(modal); // モーダルを<body>直下に移動
});

</script>

