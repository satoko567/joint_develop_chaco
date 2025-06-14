@extends('layouts.app')

@section('content')
@include('components.flash_message')

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

        {{-- リプライボタン（リンクなしにしてもOK） --}}
        <a href="{{ route('post.show', ['id' => $post->id]) }}" class="btn btn-outline-secondary btn-sm">💬リプライを見る</a>                   

        {{-- 投稿内容 --}}
        <div class="d-flex gap-3 mt-2">
            <div class="flex-grow-1">
                <p class="card-text mb-2">{{ $post->content }}</p>
            </div>

            {{-- 投稿画像 --}}
            @if ($post->image_path)
                <div class="mb-2" style="max-width: 200px;">
                    <img 
                        src="{{ asset($post->image_path) }}" 
                        alt="投稿画像" 
                        class="img-fluid mt-2" 
                        style="max-height: 100px; object-fit: contain;"
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

        {{-- 編集・削除ボタン --}}
        @if (Auth::id() === $post->user_id)
            <div class="d-flex flex-wrap justify-content-end mt-3">
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


{{-- リプライ一覧 --}}
<h5 class="mt-4">リプライ一覧</h5>

@forelse ($post->replies as $reply)
    <div class="card mb-4" style="width: 700px;">
        <div class="card-body">
            {{-- ユーザー情報 --}}
            <div class="d-flex align-items-center mb-3">
                <img class="mr-2 rounded-circle" src="{{ Gravatar::src($reply->user->email, 55) }}" alt="ユーザのアバター画像">
                <div>
                    <a href="{{ route('user.show', ['id' => $reply->user->id]) }}">{{ $reply->user->name }}</a>
                    <small class="text-muted">
                        投稿日: {{ optional($reply->created_at)->diffForHumans() }}
                        @if ($reply->updated_at && $reply->updated_at != $reply->created_at)
                            ／更新: {{ optional($reply->updated_at)->diffForHumans() }}
                        @endif
                    </small>
                </div>
            </div>

            {{-- 本文 --}}
            <div class="d-flex gap-3 mt-2">
                <div class="flex-grow-1">
                    <p class="card-text mb-2">{{ $reply->content }}</p>
                </div>
            </div>
        </div>
    </div>
@empty
    <p class="text-muted mt-4">リプライはまだありません。</p>
@endforelse


{{-- ページネーション --}}
    <div class="mt-4">
        {{ $replies->links('pagination::bootstrap-4') }}
    </div>
@endsection
