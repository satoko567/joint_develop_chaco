<!-- ユーザタブの内容 -->
<div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
    @if($users->isEmpty())
        <p>ユーザは見つかりませんでした。</p>
    @else
        <ul class="list-unstyled">
            @foreach ($users as $user)
                <li class="mb-3 text-center">
                    <div class="text-left d-inline-block w-75 mb-2">
                        @if($user->avatar)
                            <img class="mr-2 rounded-circle" src="{{ Storage::url($user->avatar) }}" alt="プロフィール画像" style="width: 55px; height: 55px;">
                        @else
                            <img class="mr-2 rounded-circle" src="{{ Gravatar::src($user->email, 55) }}" alt="アバター画像">
                        @endif
                        <p class="mt-3 mb-0 d-inline-block">
                            <a href="{{ route('user.show', $user->id) }}" class="mr-3">{{ $user->name }}</a>
                        </p>
                    </div>
                    <div class="text-left d-inline-block w-75">
                        @if($user->posts->isNotEmpty())
                            @foreach($user->posts as $post)
                                <p class="mb-0">{{ $post->content }}</p>
                                <p class="text-muted">{{ $post->created_at }}</p>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none mr-2">
                                        <i class="fas fa-comment text-muted"></i> <!-- 吹き出しアイコン -->
                                        <span class="text-muted">{{ $post->comments_count ?? 0 }}</span>
                                    </a>
                                    @include('commons.like_button') <!--Like Button -->
                                    @include('commons.bookmark_button', ['post' => $post]) <!-- Bookmark Button -->
                                </div>
                            @endforeach
                        @else
                            <p>このユーザには投稿がありません。</p>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="m-auto" style="width: fit-content">
            {{ $posts->appends(['keyword' => $keyword])->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
