@dump($keyword)
<ul class="list-unstyled">
    @foreach ($posts as $post)
        @dump($post->content)
        <li class="mb-3 text-center">
            <div class="text-left d-inline-block w-75 mb-2">
                <img class="mr-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 55) }}" alt="ユーザのアバター画像">
                <p class="mt-3 mb-0 d-inline-block"><a href="">{{ $post->user->name }}</a></p>
            </div>
            <div class="">
                <div class="text-left d-inline-block w-75">
                    {{-- 検索ワードを含む場合は、該当箇所をハイライト --}}
                    @php
                        $content = e($post->content);
                        $keyword = $keyword ?? null;

                        if (!empty($keyword)) {
                            // 複数語対応：半角スペースまたは全角スペースで分割
                            $words = preg_split('/[\s　]+/u', $keyword);

                            foreach ($words as $word) {
                                if (trim($word) === '') continue;
                                $pattern = '/' . preg_quote($word, '/') . '/iu'; // u:UTF-8, i:大文字小文字無視
                                $content = preg_replace($pattern, '<span class="highlight">$0</span>', $content);
                            }
                        }
                    @endphp

                    <p class="mb-2">{!! $content !!}</p>

                    <p class="text-muted">{{ $post->created_at }}</p>

                    @include('follow_button', ['post' => $post]) {{-- フォローボタン --}}
                </div>

                @if (Auth::id() === $post->user_id)
                    <div class="d-flex justify-content-between w-75 pb-3 m-auto">
                        <form method="" action="">
                            <button type="submit" class="btn btn-danger">削除</button>
                        </form>
                        <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary">編集する</a>
                    </div>
                @endif
            </div>
        </li>
    @endforeach
</ul>

<div class="m-auto" style="width: fit-content"></div>

<div class="pagination justify-content-center">
    {{ $posts->links('pagination::bootstrap-4') }}
</div>
