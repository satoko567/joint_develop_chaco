@extends('layouts.app')
@section('content')
    <h3>タグ: <span class="badge badge-primary">{{ $tag->name }}</span> に関連する投稿</h3>

    <ul class="list-unstyled">
        @foreach ($posts as $post)
            <li class="mb-4">
                <div class="card">
                    <div class="card-body">
                        <p>{{ $post->content }}</p>
                        <p class="text-muted">投稿日時: {{ $post->created_at->format('Y/m/d H:i') }}</p>

                        {{-- タグの表示 --}}
                        @foreach ($post->tags as $tag)
                            <span class="badge badge-info">#{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    <div class="pagination justify-content-center">
        {{ $posts->links() }}
    </div>
@endsection
