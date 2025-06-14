@if ($posts->isEmpty())
    <p class="text-center text-muted mt-4">一致する投稿はありませんでした。</p>
@else
    @foreach ($posts as $post)  
        <div class="card mb-4" style="width: 700px;">
            <div class="card-body">
                {{-- ユーザ―情報 --}}
                <div class="d-flex align-items-center mb-3">
                    <img class="mr-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 55) }}" alt="ユーザのアバター画像">
                    <div>
                        <a href="{{ route('user.show', ['id' => $post->user->id]) }}">{{ $post->user->name }}</a>
                        <small class="text-muted">
                            投稿日: {{ optional($post->created_at)->diffForHumans() }}
                            @if ($post->updated_at && $post->updated_at != $post->created_at)
                                ／更新: {{ optional($post->updated_at)->diffForHumans() }}
                            @endif
                        </small>
                    </div>
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
                {{-- 投稿内容 --}}
                <div class="d-flex gap-3">
                    <div class="flex-grow-1">
                        <p class="card-text mb-2">{{ $post->content }}</p>
                    </div>

                    {{-- 投稿画像があれば表示 --}}
                    @if ($post->image_path)
                        <div class="mb-2" style="max-width: 200px;">
                            <img 
                                src="{{ asset($post->image_path) }}" 
                                alt="投稿画像" 
                                class="img-fluid mt-2" 
                                style="max-height: 100px; object-fit: contain; pointer;"
                                data-toggle="modal"
                                data-target="#imageModal{{ $post->id }}"
                            >
                        </div>

                        {{-- モーダル --}}
                        <div class="modal fade" id="imageModal{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel{{ $post->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">画像表示</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="{{ asset($post->image_path) }}" class="img-fluid" alt="拡大画像">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                {{-- ボタン類 --}}
                @if (Auth::id() === $post->user_id)
                    <div class="d-flex flex-wrap justify-content-end">
                        <form method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-light p-1" onclick="return confirm('本当に削除しますか？')">
                                <img src="{{ asset('images/icons/ゴミ箱のアイコン素材.png') }}" alt="削除" style="width: 20px; height: 20px;">
                            </button>
                        </form>
                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-light p-1 ml-3">
                            <img src="{{ asset('images/icons/鉛筆のアイコン素材.png') }}" alt="編集" style="width: 20px; height: 20px;">
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
    <div class="m-auto" style="width: fit-content">
        {{ $posts->appends(['keyword' => request('keyword')])->links('pagination::bootstrap-4') }}
    </div>
@endif