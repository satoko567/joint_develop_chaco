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
            </div>
        </li>
    @endforeach
</ul>

<div class="m-auto" style="width: fit-content">{{ $posts->links() }}</div>
