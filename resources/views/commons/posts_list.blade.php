<div class="mt-4">
    <ul class="list-unstyled">
        @foreach ($posts as $post)
        <div class="d-flex justify-content-center align-items-center">
            <li class="card mb-3 shadow-sm dynamic-shadow w-100 border-secondary border-3">
                <div class="card-body">
                    <!-- ヘッダー部分 -->
                    <div class="d-flex align-items-center mb-3">
                        @if($post->user->avatar)
                            <img class="rounded-circle image-fluid mr-3" src="{{ Storage::url($post->user->avatar) }}" alt="プロフィール画像" style="width: 50px; height: 50px;">
                        @else
                            <img class="rounded-circle image-fluid mr-3" src="{{ Gravatar::src($post->user->email, 50) }}" alt="アバター画像">
                        @endif
                        <div>
                            <h6 class="mb-0">
                                <a href="{{ route('user.show', $post->user->id) }}" class="text-decoration-none text-dark">{{ $post->user->name }}</a>
                            </h6>
                            <small class="text-muted">{{ $post->created_at }}</small>
                        </div>
                    </div>
                    <!-- コンテンツ部分 -->
                    <div class="d-flex justify-content-between align-items-center">
                            <div class="card-text">{{ $post->content }}</div>
                            @if (Auth::id() === $post->user_id)
                                <div>
                                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-link icon-ini icon-blue" title="編集">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('post.delete', $post->id) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link icon-ini icon-red" title="削除">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                    </div>
                    <!-- アクション部分 -->
                    <div class="d-flex align-items-center mt-3">
                        <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none mr-2">
                            <i class="fas fa-comment text-muted"></i>
                            <span class="text-muted">{{ $post->comments_count ?? 0 }}</span>
                        </a>
                        @include('commons.like_button') <!-- Like Button -->
                        @include('commons.bookmark_button', ['post' => $post]) <!-- Bookmark Button -->
                    </div>
                </div>
            </li>
        </div>
        @endforeach
    </ul>
</div>

<style>
.icon-ini{
    color: gray;
    transition: color 0.3s ease;
}

.icon-red:hover {
    color: red;
    transform: scale(1.2);
    transition: color 0.3s ease, transform 0.3s ease;
}
.icon-blue:hover {
    color: blue;
    transform: scale(1.2);
    transition: color 0.3s ease, transform 0.3s ease;
}
</style>

<script>
    document.querySelectorAll('.dynamic-shadow').forEach(card => {
        card.addEventListener('mouseover', () => {
            card.style.transform = 'scale(1.05)';
            card.style.boxShadow = '0 12px 24px rgba(0, 0, 0, 0.3)';
            card.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease';
        });
        card.addEventListener('mouseout', () => {
            card.style.transform = 'scale(1)';
            card.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
        });
    });
</script>
