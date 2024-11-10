<ul class="list-unstyled">
    <!-- 検索結果がある場合 -->
    @if($keyword)
        <div class="text-left d-inline-block w-75 mb-2">
            <h5>「{{ $keyword }}」の検索結果</h5>
        </div>
        <!-- タブで投稿とユーザを切り分け -->
        <ul class="nav nav-tabs" id="searchTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">
                    投稿
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="false">
                    ユーザ
                </a>
            </li>
        </ul>

        <!-- タブ内容 -->
        <div class="tab-content" id="searchTabContent">
            <!-- 投稿タブの内容 -->
            <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                @if($posts->isEmpty())
                    <p>投稿は見つかりませんでした。</p>
                @else
                    <ul class="list-unstyled">
                        @foreach ($posts as $post)
                            <li class="mb-3 text-center">
                                <div class="text-left d-inline-block w-75 mb-2">
                                    <img class="mr-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 55) }}" alt="ユーザのアバター画像">
                                    <p class="mt-3 mb-0 d-inline-block">
                                        <a href="{{ route('user.show', $post->user->id) }}">{{ $post->user->name }}</a>
                                    </p>
                                </div>
                                <div class="text-left d-inline-block w-75">
                                    <p class="mb-2">{{ $post->content }}</p>
                                    <p class="text-muted">{{ $post->created_at }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="m-auto" style="width: fit-content">
                        {{ $posts->appends(['keyword' => $keyword])->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
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
                                        <a href="{{ route('user.show', $user->id) }}">{{ $user->name }}</a>
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
        </div>
    <!-- キーワードがない場合の全投稿一覧 -->
    @else
        @foreach($posts as $post)
            <li class="mb-3 text-center">
                <div class="text-left d-inline-block w-75 mb-2">
                    <img class="mr-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 55) }}" alt="ユーザのアバター画像">
                    <p class="mt-3 mb-0 d-inline-block">
                        <a href="{{ route('user.show', $post->user->id) }}">{{ $post->user->name }}</a>
                    </p>
                </div>
                <div class="text-left d-inline-block w-75">
                    <p class="mb-2">{{ $post->content }}</p>
                    <p class="text-muted">{{ $post->created_at }}</p>
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
        <div class="m-auto" style="width: fit-content">
            {{ $posts->appends(['keyword' => $keyword])->links('pagination::bootstrap-4') }}
        </div>
    @endif
</ul>
