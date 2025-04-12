<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
@php
    $exists = $post->user->isFollow($post->id);
@endphp

@if ($exists)
    <form method="POST" action="{{ route('follow.delete', $post->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-link p-0 border-0 bg-transparent">
            <i class="fa-regular fa-thumbs-up mb-3"></i>
        </button>
    </form>
@else
    <form method="POST" action="{{ route('follow.store', $post->id) }}">
        @csrf
        <button type="submit" class="btn btn-link p-0 border-0 bg-transparent">
            <i class="fa-solid fa-thumbs-up mb-3"></i>
        </button>
    </form>
@endif