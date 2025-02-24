@foreach($posts ?? '' as $post)
<ul class="list-unstyled">
    <li class="mb-3 text-center">

        <div class="text-left d-inline-block w-75 mb-2">

            <div class="d-flex align-items-center">
                        @if($post->user->icon && Storage::disk('public')->exists('icons/'.$post->user->icon))
                                <img src="{{ asset('storage/icons/'.$post->user->icon) }}" alt="ユーザーアイコン" class="rounded-circle img-fluid" width="65">
                        @else
                                <img src="{{ Gravatar::src($post->user->email, 55) }}" alt="ユーザのアバター画像" class="mr-2 rounded-circle">
                        @endif
                <div class="d-flex align-items-center">
                    <p class="mb-0">
                        <a href="{{ route('users.show', $post->user->id) }}">{{ $post->user->nickname }}</a>
                    </p>
                </div>
            </div>

        </div>

        <div class="">
            <div class="text-left d-inline-block w-75">
                <p class="mb-2 ">
                    <a href="{{ route('posts.comment', $post->id)}}" class="text-dark">{!! nl2br(e($post->content)) !!}</a>
                </p>
                @if ($post->image)
                     <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mt-2" alt="投稿画像">
                @endif
                <p class="text-muted mb-2">{{$post->created_at->format('Y-m-d H:i:s')}}</p>
                <p class="mb-2 mt-2">
                    Comment数
                    <span class="badge bg-warning ms-2 ">{{ CommentCounts($post)['totalReplies'] }}</span>
                    {{ getFireIcons(CommentCounts($post)['totalReplies']) }}
                </p>
            </div>

            @if(Auth::check() && Auth::user()->id === $post->user_id)
            <div class="d-flex justify-content-between w-75 pb-3 m-auto">
                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>
                <a href="{{route('post.edit', $post->id)}}" class="btn btn-primary">編集する</a>
            </div>
            @endif
        </div>
    </li>
</ul>
<div class="m-auto" style="width: fit-content"></div>
@endforeach

<div class="pagination justify-content-center">
    {{ $posts ?? ''->links('pagination::bootstrap-4') }}
</div>