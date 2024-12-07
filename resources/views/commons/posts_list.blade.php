<div class="container w-50 mt-4">
    <ul class="list-unstyled">
        @foreach ($posts as $post)
            <li class="card mb-3 shadow-sm dynamic-shadow">
                <div class="card-body">
                    <!-- ヘッダー部分 -->
                    <div class="d-flex align-items-center mb-3">
                        @if($post->user->avatar)
                            <img class="rounded-circle me-3" src="{{ Storage::url($post->user->avatar) }}" alt="プロフィール画像" style="width: 50px; height: 50px;">
                        @else
                            <img class="rounded-circle me-3" src="{{ Gravatar::src($post->user->email, 50) }}" alt="アバター画像">
                        @endif
                        <div>
                            <h6 class="mb-0">
                                <a href="{{ route('user.show', $post->user->id) }}" class="text-decoration-none text-dark">{{ $post->user->name }}</a>
                            </h6>
                            <small class="text-muted">{{ $post->created_at->format('Y年m月d日 H:i') }}</small>
                        </div>
                    </div>
                    <!-- コンテンツ部分 -->
                    <p class="card-text">{{ $post->content }}</p>
                    <!-- アクション部分 -->
                    <div class="d-flex justify-content-between align-items-center">
                        <span>
                            <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none me-3">
                                <i class="fas fa-comment"></i> {{ $post->comments_count ?? 0 }}
                            </a>
                            @include('commons.like_button') <!-- Like Button -->
                        </span>
                        @if (Auth::id() === $post->user_id)
                            <div>
                                <form method="POST" action="" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">削除</button>
                                </form>
                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary btn-sm">編集</a>
                            </div>
                        @endif
                    </div>
                </div>
            </li>
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
        @endforeach
    </ul>
</div>