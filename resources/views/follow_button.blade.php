@php
    $exists = Auth::check() ? Auth::user()->isFollow($post->id) : false;
    $countFollowUsers = $post->followUsers()->count();
@endphp

@if (Auth::id()!== $post->user_id)
    @if ($exists)
        <form method="POST" action="{{ route('follow.delete', $post->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-link p-0 border-0 bg-transparent">
                <i class="fa-solid fa-thumbs-up mb-3 mr-1"></i>{{$countFollowUsers}}
            </button>
        </form>
    @else
        <form method="POST" action="{{ route('follow.store', $post->id) }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 border-0 bg-transparent">
                <i class="fa-regular fa-thumbs-up mb-3 mr-1"></i>{{$countFollowUsers}}
            </button>
        </form>
    @endif

    <script>
        // スクロール位置を記録
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function () {
                sessionStorage.setItem('scrollPosition', window.scrollY);
            });
        });

        // ページロード後に元の位置へスクロール
        window.addEventListener('load', function () {
            const scrollY = sessionStorage.getItem('scrollPosition');
            if (scrollY !== null) {
                window.scrollTo(0, parseInt(scrollY));
                sessionStorage.removeItem('scrollPosition'); // 1回だけ使う
            }
        });
    </script>

@else
    <span class="badge badge-info mb-4">
        フォロー数：{{ $countFollowUsers}}
    </span>
@endif