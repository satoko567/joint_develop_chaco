<ul class="list-unstyled">
    <!-- 検索結果がある場合 -->
    @if($keyword !== null && $keyword)
        <div class="text-left d-inline-block w-75 mb-2">
            <h5>「{{ $keyword }}」の検索結果</h5>
        </div>
        
        <!-- タブで投稿とユーザを切り分け -->
        <ul class="nav nav-tabs mt-2 mb-4" id="searchTab" role="tablist">
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
                        @include('commons.posts_list')
                    </ul>
                    <div class="m-auto" style="width: fit-content">
                        {{ $posts->appends(['keyword' => $keyword])->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
            <!-- ユーザタブの内容 -->
            @include('users.users')
        </div>
    <!-- キーワードがない場合の全投稿一覧 -->
    @else
        @include('commons.posts_list')
        <div class="m-auto" style="width: fit-content">
            {{ $posts->links('pagination::bootstrap-4') }}
        </div>
    @endif
</ul>