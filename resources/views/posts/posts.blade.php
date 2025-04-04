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
                @if($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="投稿画像" class="img-thumbnail clickable-image" style="width: 200px; cursor: pointer;" data-image="{{ asset('storage/' .$post->image_path) }}" >
                @endif
                <p class="text-muted">{{ $post->created_at }}</p>
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

<div class="m-auto" style="width: fit-content">{{ $posts->links() }}</div>

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

