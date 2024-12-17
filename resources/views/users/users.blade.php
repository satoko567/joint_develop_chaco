<!-- ユーザタブの内容 -->
<div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
    @if($users->isEmpty())
        <p>ユーザは見つかりませんでした。</p>
    @else
        <ul class="list-unstyled">
            @foreach ($users as $user)
                <li class="mb-3 text-center">
                    <div class="text-left d-inline-block w-75 mb-2">
                        <img class="mr-2 rounded-circle" src="{{ Gravatar::src($user->email, 55) }}" alt="ユーザのアバター画像">
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
                                    <a href="{{ route('post.show', $post->id) }}" class="mr-2">
                                        <i class="fas fa-comment"></i> <!-- 吹き出しアイコン -->
                                        {{ $post->comments_count ?? 0 }}
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
