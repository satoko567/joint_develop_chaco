@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column">
        {{-- 投稿内容 --}}
        <div class="w-75 m-auto">
            <div class="mb-3 text-center">
                <div class="p-2 text-left d-inline-block w-75" style="background-color: #eff7ff">
                    <img class="mr-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 65) }}" alt="ユーザのアバター画像">
                    <p class="mt-3 mb-0 d-inline-block">
                        <a href="{{ route('user.show', $post->user_id) }}">{{ $post->user->name }}</a>
                    </p>
                </div>
                <div class="p-2 text-left d-inline-block w-75" style="background-color: #eff7ff">
                    <p class="mb-2">{{ $post->content }}</p>
                    <p class="text-muted mb-0">{{ $post->created_at }}</p>
                    <hr class="m-0 mb-1">
                    <a class="text-dark text-decoration-none" href="#replyList" onclick="scrollReplyList(event)"
                        data-toggle="tooltip" title="Reply">
                        <i class="far fa-comment-dots fa-lg"></i><span>&nbsp;{{ $post->replies->count() }}</span>
                    </a>
                </div>
            </div>

            {{-- リプライ表示 --}}
            <div class="mb-3 text-center">
                <div id="replyList" class="text-left d-inline-block w-75">
                    <h4 class="mt-2 mb-2 py-2 pl-2 border-top border-bottom border-dark">
                        リプライ一覧
                    </h4>
                </div>
            </div>
            @if ($post->replies->isEmpty())
                {{-- リプライ数が０件の場合の処理 --}}
                <div class="mb-3 text-center">
                    <div id="replyList" class="text-left d-inline-block w-75">
                        <p class="m-0 d-inline-block">
                            リプライがありません
                        </p>
                    </div>
                </div>
            @else
                {{-- リプライ数が1件以上ある場合の処理 --}}
                @foreach ($replies as $reply)
                    <div class="mb-3 text-center">
                        <div class="text-left d-inline-block w-75 mb-2 pl-2">
                            <img class="mr-2 rounded-circle" src="{{ Gravatar::src($reply->user->email, 45) }}"
                                alt="ユーザのアバター画像">
                            <p class="mt-3 mb-0 d-inline-block">
                                <a href="{{ route('user.show', $reply->user_id) }}">{{ $post->user->name }}</a>
                            </p>
                        </div>
                        <div class="text-left d-inline-block w-75 pl-2">
                            <p class="mb-2">{{ $reply->content }}</p>
                            <p class="text-muted">{{ $reply->created_at }}</p>
                        </div>
                        <hr class="mt-0 mb-0 w-75">
                    </div>
                @endforeach
            @endif
        </div>

        {{-- ページネーションの表示 --}}
        <div class="m-auto" style="width: fit-content">
            {{ $replies->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection

<script>
    function scrollReplyList(event) {
        event.preventDefault();
        const replyList = document.getElementById("replyList");
        const replyListTop = replyList.getBoundingClientRect().top + window.pageYOffset;
        window.scrollTo({
            top: replyListTop,
            behavior: 'smooth'
        });
    }
</script>
