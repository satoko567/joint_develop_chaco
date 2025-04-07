<ul class="list-unstyled">
    @foreach ($posts as $post)
        <li class="mb-3 text-center">
            <div>{{ $post->name }}</div>
            <div class="text-left d-inline-block w-75 mb-2">
                <img class="mr-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 55) }}" alt="ユーザのアバター画像">
    
                <a href="{{ route('user.show', ['id' => $post->user->id]) }}"style="text-decoration: none; color: blue;">
                    {{ $post->user->name }}
                </a>
            </div>

            <div class="text-left d-inline-block w-75">
                <p class="mb-2">{{ $post->content }}</p>
                <p class="text-muted">{{ $post->created_at }}</p>
                {{-- ここにいいねボタンを追加 --}}
                <div class="d-inline-block">
                    <form method="POST" action="{{ route('posts.like', $post->id) }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-light">
                            👍 {{ ($post->likes ?? collect([]))->count() }}
                        </button>
                            @if (session('error') && session('error_post_id') === $post->id)
                            <div class="alert alert-danger ml-2 d-inline-block" style="vertical-align: middle;">
                            {{ session('error') }}
                            </div>
                            @endif
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

<div class="m-auto" style="width: fit-content">{{ $posts->links() }}</div>
