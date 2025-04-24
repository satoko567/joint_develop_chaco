{{-- タグをクリックした際、そのタグと同じワードのタグをつけてる投稿を一覧表示するページ --}}
@extends('layouts.app')
@section('content')
    <h3>タグ: <span class="badge badge-primary">{{ $tag->name }}</span> に関連する投稿</h3>

    <ul class="list-unstyled">
        @foreach ($posts as $post)
            <li class="mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="text-left d-inline-block w-10 mb-2">
                            <img class="avatar mr-2" src="{{ Gravatar::src($post->user->email, 55) }}" alt="ユーザのアバター画像">
                            <p class="mt-3 mb-0 d-inline-block"><a href="">{{$post->user->name}}</a></p>
                        </div>
                        <hr class="hr1">
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
