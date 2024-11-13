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
                            <a href="{{ route('post.show', $user->id) }}">投稿詳細</a>

                        </p>
                    </div>
                    <div class="text-left d-inline-block w-75">
                        @if($user->posts->isNotEmpty())
                            @foreach($user->posts as $post)
                                <p class="mb-2">{{ $post->content }}</p>
                                <p class="text-muted">{{ $post->created_at }}</p>
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
