<li class="list-group-item">
    <div class=" m-auto pb-3 pt-3 ">{{--border-bottom--}}
        <div class="d-flex align-items-center mb-2">
            <img src="{{ Gravatar::src($comment->user->email, 50) }}" alt="ユーザのアバター画像" class="mr-2 rounded-circle">
            <a href="{{ route('users.show', $comment->user->id) }}">
                {{ $comment->user->nickname ?? '名無し' }}
            </a>
        </div>
        <p class="mb-2">{{ $comment->content }}</p>
        <p class="text-muted" style="font-size: 0.8em; margin-bottom: 0;">
            {{ $comment->created_at->format('Y-m-d H:i') }}
            @if ($comment->updated_at && $comment->updated_at->ne($comment->created_at))
            （編集済み）
            @endif
        </p>
    </div>

    @if(Auth::check() && in_array(Auth::user()->id, [$comment->post->user_id, $comment->user_id]))
    <div class="d-flex justify-content-start w-100 pb-3 m-auto gap-2">
        <div class="comment-container position-relative w-100">
            <!-- 削除ボタン -->
            <div class="comment-actions d-inline-block">
                <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">削除</button>
                </form>
                @if(Auth::check() && Auth::user()->id === $comment->user_id)
                <!-- 編集ボタン -->
                <button class="btn btn-info btn-sm d-inline-block" onclick="editComment({{ $comment->id }})">編集</button>
                @endif
            </div>
            <!-- 編集フォーム -->
            <div id="edit-form-{{ $comment->id }}" class="w-100 edit-form d-none border rounded p-2 bg-white shadow-sm mt-2">
                <form action="{{ route('comment.update', ['commentId' => $comment->id]) }}" method="POST" class="w-100">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="parent_id" value="{{ $comment->parent_id }}">
                    <textarea name="content" class="form-control w-100" rows="2" required>{{ $comment->content }}</textarea>
                    <button type="submit" class="btn btn-primary btn-sm mt-2">保存</button>
                </form>
            </div>
        </div>

    </div>
    @endif

    {{-- 返信フォーム --}}
    <button class="btn btn-link btn-sm" onclick="replyToComment({{ $comment->id }})">返信</button>
    <form id="reply-form-{{ $comment->id }}" action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-2" style="display: none;">
        @csrf
        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
        <textarea name="content" class="form-control" rows="2" required></textarea>
        <button type="submit" class="btn btn-primary btn-sm mt-2">返信を投稿</button>
    </form>

    {{-- 子コメントの表示 --}}
    @if ($comment->replies->count())
    <ul class="list-group mt-2">
        @foreach ($comment->replies as $reply)
        @include('posts.commentPartial', ['comment' => $reply])
        @endforeach
    </ul>
    @endif
</li>

<script>
    function replyToComment(commentId) {
        const form = document.getElementById(`reply-form-${commentId}`);
        if (form) {
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
            const parentInput = form.querySelector('input[name="parent_id"]');
            if (!parentInput) {
                console.error(`parent_id input not found for commentId: ${commentId}`);
            }
        } else {
            console.error(`Reply form not found for commentId: ${commentId}`);
        }
    }

    function editComment(commentId) {
        const form = document.getElementById(`edit-form-${commentId}`);
        form.classList.toggle('d-none');
    }
</script>