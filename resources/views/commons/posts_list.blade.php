@foreach ($posts as $post)
    <li class="mb-3 text-center">
        <div class="text-left d-inline-block w-75 mb-2">
            @if($post->user->avatar)
                <img class="mr-2 rounded-circle" src="{{ Storage::url($post->user->avatar) }}" alt="現在のプロフィール画像" style="width: 55px; height: 55px;">
            @else
                <img class="mr-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 55) }}" alt="ユーザのアバター画像">
            @endif 
            <p class="mt-3 mb-0 d-inline-block">
                <a href="{{ route('user.show', $post->user->id) }}" class="mr-3">{{ $post->user->name }}</a>
            </p>
        </div>
        <div class="text-left d-inline-block w-75">
            <p class="mb-1">{{ $post->content }}</p>
            <p class="text-muted mb-0">{{ $post->created_at }}</p>
            <div class="d-flex align-items-center">
                <a href="{{ route('post.show', $post->id) }}" class="mr-2">
                    <i class="fas fa-comment"></i> <!-- 吹き出しアイコン -->
                    {{ $post->comments_count ?? 0 }}
                </a>
                @include('commons.like_button') <!--Like Button -->
            </div>
        </div>
        @if (Auth::id() === $post->user_id)
            <div class="d-flex justify-content-between w-75 pb-3 m-auto">
                <form method="" action="">
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>
                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">編集する</a>
            </div>
        @endif
    </li>
@endforeach