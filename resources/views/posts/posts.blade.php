<ul class="list-unstyled">
    @foreach ($posts as $post)
        <li class="mb-4 d-flex justify-content-center">
            <div class="row border rounded p-3 w-100 mx-auto" style="max-width: 800px;">
                <div class="col-md-5 mb-3 text-center d-flex align-items-center">
                    @if ($post->image_path)
                        <img src="{{ asset('storage/' . $post->image_path) }}" class="img-thumbnail clickable-image"
                            style="cursor: pointer;" alt="投稿画像"
                            data-image="{{ asset('storage/' . $post->image_path) }}">
                    @else
                        <img class="img-thumbnail clickable-image my-1" src="{{ asset('images/top.png') }}"
                            style="cursor: pointer;" data-image="{{ asset('images/top.png') }}">
                    @endif
                </div>
                <div class="col-md-6">
                    <div>
                        <img class="me-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 30) }}"
                            alt="ユーザのアバター画像">
                        <a href="{{ route('user.show', ['id' => $post->user->id]) }}"
                            class="text-decoration-none text-primary">{{ $post->user->name }}</a>
                        <p class="text-muted mb-1">{{ $post->created_at }}</p>
                    </div>
                    <h2 class="h5 mb-3" style="word-break: break-word;">{{ $post->content }}</h2>
                    <div class="d-flex gap-2">
                        @include('posts.components._replies_likes_buttons', ['post' => $post])
                    </div>
                    <div style="margin-top: 10px;">
                        @include('posts.components._post_actions')
                    </div>
                </div>
            </div>
        </li>
    @endforeach
</ul>

<div class="m-auto" style="width: fit-content">
    {{ $posts->appends(['keyword' => request()->query('keyword', '')])->links() }}
</div>

@include('posts.image_modal')
