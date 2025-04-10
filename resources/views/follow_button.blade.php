@php
    $postId = post()->post_id;
@endphp

<form method="POST" action="{{ route('follow.store', $postId) }}">
    @csrf
    <button type="submit" class="btn btn-primary">
        @if ($isFollow($postId))
            フォロー中
        @else
            フォローする
        @endif
    </button>
</form>