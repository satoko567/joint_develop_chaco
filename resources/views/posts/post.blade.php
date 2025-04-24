<ul class="list-unstyled">
    @foreach ($posts as $post)
        <li class="mb-3 text-center">
            <div class="text-left d-inline-block w-75 mb-2">
                <img class="mr-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 55) }}" alt="ユーザのアバター画像">
                <p class="mt-3 mb-0 d-inline-block"><a href="">{{ $post->user->name }}</a></p>
            </div>
            <div class="">
                <div class="text-left d-inline-block w-75">
                    {{-- 検索ワードを含む場合は、該当箇所をハイライト --}}
                    @php
                        $content = e($post->content); // XSS対策のエスケープ
                        $keyword = $keyword ?? null; // $keywordが定義されてないなら、nullを代入。未定義エラーを防ぐ。

                        if (!empty($keyword)) { // 検索キーワードが存在すれば、ハイライト処理に入る。
                            // 複数語対応：半角スペースまたは全角スペースで分割
                            $words = preg_split('/[\s　]+/u', $keyword);

                            foreach ($words as $word) { // 分割したキーワードを１つ１つ、処理する。
                                if (trim($word) === '') continue; // trim()で空白を取り除く。空文字の時は、continueでスキップ。
                                $pattern = '/' . preg_quote($word, '/') . '/iu'; // キーワード中に / や . などの特殊文字が含まれていた場合、それを正規表現の文字として無効化。 u:UTF-8, i:大文字小文字無視
                                $content = preg_replace($pattern, '<span class="highlight">$0</span>', $content); // 投稿本文中のキーワードと一致した部分を <span class="highlight"> で囲む。 $0はキーワードが入る。
                            }
                        }
                    @endphp

                    {{-- 投稿内容 --}}
                    <p class="mb-2">{!! $content !!}</p>
                    <p class="text-muted">{{ $post->created_at }}</p>

                    {{-- フォローボタン --}}
                    @include('buttons.follow_button', ['post' => $post]) 
                </div>

                {{-- タグの表示 --}}
                <div class="text-left d-inline-block w-75">
                    @foreach ($post->tags as $tag)
                        <a href="{{ route('tags.show', $tag->id) }}" class="badge badge-success">#{{ $tag->name }}</a>
                    @endforeach
                </div>

                {{-- 投稿の削除・編集ボタン --}}
                @if (Auth::id() === $post->user_id)
                    <div class="d-flex justify-content-between w-75 pb-3 m-auto">
                        <form method="" action="">
                            <button type="submit" class="btn btn-danger mt-3">削除</button>
                        </form>
                        <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary mt-3">編集する</a>
                    </div>
                @endif
            </div>
        </li>
        <hr class="hr1">
    @endforeach
</ul>

<div class="m-auto" style="width: fit-content"></div>

<div class="pagination justify-content-center">
    {{ $posts->links('pagination::bootstrap-4') }}
</div>
