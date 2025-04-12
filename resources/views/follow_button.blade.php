@php
    //$exists = $user()->isFollow($id);
@endphp

<form method="POST" action="{{ route('follow.store', $post->id) }}">
    @csrf
    <button type="submit" class="btn btn-primary">
        @if ($exists)
            フォロー中
        @else
            フォローする
        @endif
    </button>
</form>