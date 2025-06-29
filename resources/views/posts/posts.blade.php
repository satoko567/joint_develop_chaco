@foreach ($posts as $post)
    <div class="card mb-4" style="width: 700px;">
        <div class="card-body">
        
            {{-- ユーザ―情報 --}}
            <div class="d-flex align-items-center mb-3">
                <img class="mr-2 rounded-circle" 
                    src="{{ $post->user->avatar_image_url }}" 
                    width="55" height="55"
                    style="object-fit: cover;" 
                    alt="ユーザのアバター画像">
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

            {{-- 投稿内容と画像 --}}
            <div class="d-flex gap-3">
                <div class="flex-grow-1">
                    <p class="card-text mb-2">{{ $post->content }}</p>
                </div>

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
                    <div class="modal fade" id="imageModal{{ $post->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">画像表示</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
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

            {{-- タグ表示（リンク付き） --}}
            @if ($post->tags->isNotEmpty())
                <div class="mb-2 text-left">
                    @foreach ($post->tags as $tag)
                        <a href="{{ route('tags.search', ['id' => $tag->id]) }}" class="badge badge-pill badge-info">
                            #{{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            @endif
            {{-- リプライ＋編集削除 --}}
            <div class="d-flex justify-content-between align-items-center mt-4">
                
                {{-- リプライ --}}
                <a href="{{ route('post.show', ['id' => $post->id]) }}" class="btn btn-outline-secondary btn-sm">
                    💬リプライ
                </a>

                {{-- 編集・削除 --}}
                @if (Auth::id() === $post->user_id)
                    <div class="d-flex">
                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-light p-1">
                            <img src="{{ asset('images/icons/鉛筆のアイコン素材.png') }}" alt="編集" style="width: 20px; height: 20px;">
                        </a>
                        <form method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-light p-1 ml-3" onclick="return confirm('本当に削除しますか？')">
                                <img src="{{ asset('images/icons/ゴミ箱のアイコン素材.png') }}" alt="削除" style="width: 20px; height: 20px;">
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endforeach
<div class="d-flex justify-content-center mt-4">
    {{ $posts->links() }}
</div>

