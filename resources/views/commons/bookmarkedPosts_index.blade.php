@if($bookmarkedPosts->isEmpty())
    <p>ブックマークされた投稿はありません。</p>
@else
<ul class="list-unstyled">
    @foreach ($bookmarkedPosts as $post)
        <li class="mb-3 text-center">
            <div class="row align-items-center w-75 mx-auto">
                <div class="col-8 d-flex align-items-center">
                    <img class="mr-2 rounded-circle" src="{{ Gravatar::src($user->email, 55) }}" alt="ユーザのアバター画像">
                    <p class="mb-0">
                        <a href="{{ route('user.show', $post->user->id) }}">{{ $post->user->name }}</a>
                    </p>
                </div>
            </div>
        </li>
    @endforeach
</ul>
    <div class="m-auto" style="width: fit-content">
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
@endif