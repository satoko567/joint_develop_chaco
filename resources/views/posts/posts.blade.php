<ul class="list-unstyled">
    @if ($posts->isEmpty())
        <li class="text-center text-muted py-3">投稿が見つかりませんでした。</li>
    @endif
    @foreach ($posts as $post)
        <li class="mb-3 text-center">
            <div class="text-left d-inline-block w-75 mb-2">
                <img class="mr-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 55) }}" alt="ユーザのアバター画像">
                {{--<p class="mt-3 mb-0 d-inline-block"><a href="{{ route('users.show', $post->user->id) }}">{{ $post->user->name }}</a></p>--}} {{-- ユーザー名（詳細ページ完成後にリンクを復活） --}}
                <p class="mt-3 mb-0 d-inline-block">{{ $post->user->name }}</p>

               @if (Auth::check() && Auth::id() !== $post->user->id)   {{-- フォローボタン（ログインユーザーが他ユーザーの投稿の場合） --}}
                    <div class="d-inline-block ml-3">
                        @if (Auth::user()->isFollowing($post->user->id))
                            <form method="POST" action="{{ route('unfollow', $post->user->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">フォロー解除</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('follow', $post->user->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary">フォローする</button>
                            </form>
                        @endif
                    </div>
                @endif
            </div>
            <div class="">  {{-- 投稿本文 --}}
                <div class="text-left d-inline-block w-75">
                    <p class="mb-2">
                        <a href="{{ route('posts.show', $post->id) }}"
                        style="color: #212529; text-decoration: none; transition: color 0.2s;"
                        onmouseover="this.style.color='#007bff'; this.style.textDecoration='underline';"
                        onmouseout="this.style.color='#212529'; this.style.textDecoration='none';">
                            {{ $post->content }}
                        </a>
                    </p>
                    <p class="mb-1 text-muted" style="font-size: 0.9em;">
                        {{-- 今後ここに「いいね数」などを追加 --}}
                        {{-- 例：| いいね {{ $post->likes_count }} 件 --}}
                        {{-- 配置場所やデザインをカスタマイズしてもらって大丈夫です --}}
                        リプライ {{ $post->replies_count }} 件
                    </p>
                    <p class="text-muted">{{ $post->created_at }}</p>
                </div>
                @if (Auth::id() === $post->user_id)  {{-- 投稿者のみ表示：削除・編集 --}}
                    <div class="d-flex justify-content-between w-75 pb-3 m-auto">
                       <form method="POST" action="">   {{-- 削除ルート実装後に記述 --}}
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">削除</button>
                        </form>
                        <a href="" class="btn btn-primary">編集する</a>   {{-- 編集ルート実装後に記述 --}}
                    </div>
                @endif
            </div>
        </li>
    @endforeach
</ul>
<div class="m-auto" style="width: fit-content">
    {{ $posts->appends(['keyword' => $keyword])->links('pagination::bootstrap-4') }}
</div>