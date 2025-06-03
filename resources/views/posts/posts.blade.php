@if ($posts->isEmpty())
    <p class="text-center text-muted py-3">投稿が見つかりませんでした。</p>
@endif

<div class="row">
    @foreach ($posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">

                    {{-- 👤 ユーザー情報 --}}
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ Gravatar::src($post->user->email, 55) }}" class="rounded-circle mr-3" alt="ユーザのアバター画像">
                        <div>
                            <p class="mb-1 font-weight-bold">{{ $post->user->name }}</p>
                            @if (Auth::check() && Auth::id() !== $post->user->id)
                                <div>
                                    @if (Auth::user()->isFollowing($post->user->id))
                                        <form method="POST" action="{{ route('unfollow', $post->user->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">フォロー解除</button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('follow', $post->user->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-primary">フォローする</button>
                                        </form>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- 評価（★） --}}
                    @if ($post->rating)
                        <div class="mb-2">
                            評価:
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $post->rating)
                                    <span style="color: gold;">★</span>
                                @else
                                    <span style="color: #ccc;">★</span>
                                @endif
                            @endfor
                        </div>
                    @endif

                    {{-- 📷 投稿画像（常に表示：投稿者が画像を投稿していない場合はデフォルト） --}}
                    @php
                        $imageUrl = $post->image
                            ? asset('storage/' . $post->image)
                            : asset('images/no_image.png');
                    @endphp
                    <a href="{{ route('posts.show', $post->id) }}">
                    <img src="{{ $imageUrl }}"
                        class="img-fluid rounded mb-3 w-100"
                        style="height: 200px; object-fit: contain; background-color: #f8f9fa;"
                        alt="投稿画像">
                    </a>
                    {{-- 📝 投稿内容 --}}
                    <p class="card-text mb-2" style="max-height: 120px; overflow: hidden; text-overflow: ellipsis;">
                        <a href="{{ route('posts.show', $post->id) }}" style="color: #212529; text-decoration: none;">
                           {{ Str::limit(strip_tags($post->content), 120, '... 続きを読む') }}
                        </a>
                    </p>
                    <p class="text-muted small mb-1">リプライ {{ $post->replies_count }} 件</p>
                    <p class="text-muted">{{ $post->created_at }}</p>
                </div>

                {{-- 🛠 編集・削除（投稿者のみ） --}}
                @if (Auth::id() === $post->user_id)
                    <div class="card-footer bg-white d-flex justify-content-between">
                        <form method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">削除</button>
                        </form>
                        <a href="" class="btn btn-sm btn-primary">編集する</a>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>

<div class="d-flex justify-content-center">
    {{ $posts->appends(['keyword' => $keyword])->links('pagination::bootstrap-4') }}
</div>
