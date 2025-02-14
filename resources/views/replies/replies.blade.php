@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column">
        {{-- 投稿内容 --}}
        <div class="w-75 m-auto">
            <div class="mb-0 text-center">
                <div class="p-2 text-left d-inline-block w-75" style="background-color: #eff7ff">
                    <img class="mr-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 65) }}" alt="ユーザのアバター画像">
                    <p class="mt-3 mb-0 d-inline-block">
                        <a href="{{ route('user.show', $post->user_id) }}">{{ $post->user->name }}</a>
                    </p>
                </div>
                <div class="p-2 text-left d-inline-block w-75" style="background-color: #eff7ff">
                    <p class="mb-2">{{ $post->content }}</p>
                    <p class="text-muted mb-0">{{ $post->created_at }}</p>
                    <hr class="m-0 mb-1">
                    <a class="text-dark text-decoration-none" href="#replyList" onclick="scrollReplyList(event)"
                        data-toggle="tooltip" title="Reply">
                        <i class="far fa-comment-dots fa-lg"></i>
                        <span id="reply-count-{{ $post->id }}">{{ $post->replies->count() }}</span>
                    </a>
                </div>
                {{-- リプライフォームの表示・非表示 --}}
                @if (Auth::check())
                    <form method="POST" action="{{ route('reply.store', $post->id) }}" class="mt-2 d-inline-block w-75"
                        id="reply-form-{{ $post->id }}">
                        @csrf
                        <div class="form-group mb-0">
                            <textarea class="form-control" name="content" rows="2" placeholder="ここに返信内容を入力..."
                                id="textarea-{{ $post->id }}"></textarea>
                            <div class="text-right mt-2">
                                <button type="button" class="btn btn-outline-secondary ml-2"
                                    id="cancel-button-{{ $post->id }}">キャンセル</button>
                                <button type="submit" class="btn btn-outline-primary">返信する</button>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="mt-2 d-inline-block w-75 text-right">
                        <button type="button" class="btn btn-primary" onclick="confirmLogin()">返信する</button>
                    </div>
                @endif
            </div>

            {{-- リプライ表示 --}}
            <div class="mb-3 text-center">
                <div id="replyList" class="text-left d-inline-block w-75">
                    <h4 class="mt-2 mb-2 py-2 pl-2 border-top border-bottom border-dark">
                        リプライ一覧
                    </h4>
                </div>
            </div>
            @if ($post->replies->isEmpty())
                {{-- リプライ数が０件の場合の処理 --}}
                <div class="mb-3 text-center">
                    <div id="replyList" class="text-left d-inline-block w-75">
                        <p class="m-0 d-inline-block">
                            リプライがありません
                        </p>
                    </div>
                </div>
            @else
                {{-- リプライ数が1件以上ある場合の処理 --}}
                @foreach ($replies as $reply)
                    <div class="mb-3 text-center">
                        <div class="text-left d-inline-block w-75 mb-2 pl-2">
                            <img class="mr-2 rounded-circle" src="{{ Gravatar::src($reply->user->email, 45) }}"
                                alt="ユーザのアバター画像">
                            <p class="mt-3 mb-0 d-inline-block">
                                <a href="{{ route('user.show', $reply->user_id) }}">{{ $reply->user->name }}</a>
                            </p>
                        </div>
                        <div class="text-left d-inline-block w-75 pl-2">
                            <p class="mb-2">{{ $reply->content }}</p>
                            <p class="text-muted">{{ $reply->created_at }}</p>
                        </div>
                        <hr class="mt-0 mb-0 w-75">
                    </div>
                @endforeach
            @endif
        </div>

        {{-- ページネーションの表示 --}}
        <div class="m-auto" style="width: fit-content">
            {{ $replies->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const replyForm{{ $post->id }} = document.getElementById('reply-form-{{ $post->id }}');
        const cancelButton{{ $post->id }} = document.getElementById('cancel-button-{{ $post->id }}');
        const textarea{{ $post->id }} = document.getElementById('textarea-{{ $post->id }}');
        const replyCount{{ $post->id }} = document.getElementById('reply-count-{{ $post->id }}');
        var isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};

        if (isLoggedIn) {
            // キャンセルボタンをクリックしたときテキストエリアを空にする
            cancelButton{{ $post->id }}.addEventListener('click', function() {
                textarea{{ $post->id }}.value = '';
            });

            // 返信ボタンをクリック時の処理
            replyForm{{ $post->id }}.addEventListener('submit', function(event) {
                // フォーム送信前のバリデーションチェック
                event.preventDefault();
                const content = textarea{{ $post->id }}.value.trim();
                if (content === '') {
                    alert('返信内容を入力してください（空白や改行のみは無効です）。');
                    return;
                }
                const formData = new FormData(replyForm{{ $post->id }});
                fetch(replyForm{{ $post->id }}.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status) {
                            // リプライ投稿成功
                            replyCount{{ $post->id }}.textContent = data.reply_count;
                            textarea{{ $post->id }}.value = '';
                            location.reload();
                        } else {
                            // バリデーションエラーメッセージダイアログ
                            alert(data.errors.content[0]);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('リプライの投稿に失敗しました。');
                    });
            });
        }
    });

    // 未ログイン時に返信ボタンクリックした時の処理
    function confirmLogin() {
        var currentUrl = window.location.href;
        sessionStorage.setItem('previousUrl', currentUrl);
        var loginUrl = "{{ route('login') }}";
        if (confirm("ログインが必要です。ログインページに移動しますか？")) {
            window.location.href = loginUrl;
        }
    }

    // コメントアイコンクリックした時の処理
    function scrollReplyList(event) {
        event.preventDefault();
        const replyList = document.getElementById("replyList");
        const replyListTop = replyList.getBoundingClientRect().top + window.pageYOffset;
        window.scrollTo({
            top: replyListTop,
            behavior: 'smooth'
        });
    }
</script>
