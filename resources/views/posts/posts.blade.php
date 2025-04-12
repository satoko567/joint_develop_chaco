<ul class="list-unstyled">
    @foreach ($posts as $post)
    <li class="mb-3 text-center">
        <div>{{ $post->name }}</div>
        <div class="text-left d-inline-block w-75 mb-2">
            <img class="mr-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 55) }}" alt="ユーザのアバター画像">
            <a href="{{ route('user.show', ['id' => $post->user->id]) }}" style="text-decoration: none; color: blue;">
                {{ $post->user->name }}
            </a>
        </div>

            <div class="text-left d-inline-block w-75">
                <p class="mb-2">{{ $post->content }}</p>

                @foreach ($post->images as $image)
                    <img alt="投稿画像" src="{{ asset('storage/' . $image->image_path) }}" class="img-thumbnail clickable-image mb-2" style="width: 200px; cursor: pointer;" data-image="{{ asset('storage/'. $image->image_path) }}">
                @endforeach
                <p class="text-muted">{{ $post->created_at }}</p>
                {{-- ここにいいねボタンを追加 --}}
                <div class="d-inline-block">
                {{-- 💬リプライリンク ← 追加する！ --}}
                <a href="{{ route('replies.index', $post->id) }}" class="btn btn-light">
                💬 {{ $post->replies->count() }}
                </a>
                    <form method="POST" action="{{ route('posts.like', $post->id) }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-light"
                        @if (Auth::id() === $post->user_id) disabled @endif>
                            👍 {{ ($post->likes ?? collect([]))->count() }}
                        </button>
                    </form>
                </div>
            </div>
            <div class="d-flex justify-content-between w-75 pb-3 m-auto">
                        @if (Auth::id() === $post->user_id)
                            <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">削除</button>
                            </form>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">編集する</a>
                        @endif
            </div>
        </li>
    @endforeach
</ul>

<div class="m-auto" style="width: fit-content">
{{ $posts->appends(['keyword' => request()->query('keyword', '')])->links() }}
</div>

<!-- モーダル -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img id="modalImage" src="" alt="拡大画像" class="img-fluid">
            </div>
        </div>
    </div>
</div>

