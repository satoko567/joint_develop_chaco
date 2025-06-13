@if ($posts->isEmpty())
    <p class="text-center text-muted mt-4">一致する投稿はありませんでした。</p>
@else
    @foreach ($posts as $post)  
        <ul class="list-unstyled">
            <li class="mb-3 text-center">
                <div class="text-left d-inline-block w-75 mb-2">
                    <img class="mr-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 55) }}" alt="ユーザのアバター画像">
                    <p class="mt-3 mb-0 d-inline-block"><a href="{{ route('user.show', ['id' => $post->user->id]) }}">{{ $post->user->name }}</a></p>
                </div>
                <div class="">
                    <div class="text-left d-inline-block w-75">
                        <p class="mb-2">{{ $post->content }}</p>
                        <p class="text-muted">{{ $post->created_at }}</p>
                        <a href="{{ route('post.show', ['id' => $post->id]) }}" class="btn btn-outline-secondary btn-sm">💬リプライを見る</a>                   
                    </div>
                        <br>
                        <br>
                    @if (Auth::id() === $post->user_id)
                        <div class="d-flex justify-content-between w-75 pb-3 m-auto">
                            <form method="POST" action="">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">削除</button>
                            </form>
                            <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-primary">編集する</a>
                        </div>
                    @endif
                </div>
            </li>
        </ul>
    @endforeach
    <div class="m-auto" style="width: fit-content">
        {{ $posts->appends(['keyword' => request('keyword')])->links('pagination::bootstrap-4') }}
    </div>
@endif