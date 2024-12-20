<!-- 右のサイドバー -->
<div class="col-3 pr-5">
    <div class="card shadow-sm mx-0 border-secondary">
        <div class="card-header bg-light text-dark text-left border-secondary" >
            <h5 class="m-0 p-0">Search</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('search.index') }}">
                <div class="form-group mb-3">
                    <input type="text" name="keyword" class="form-control border-secondary" placeholder="キーワードで検索" value="{{ request('keyword') }}">
                </div>
                <button type="submit" class="btn btn-secondary w-100">Search</button>
            </form>
        </div>
    </div>
    @if (auth()->check())
    <div class="card shadow-sm mx-0 border-secondary mt-5">
        <div class="card-header bg-light text-dark text-left border-secondary">
            <h5 class="m-0 p-0">who to follow</h5>
            </div>
                <div class="card-body">
                    @if (!$hasSimilarUsers && $similarUsers->isEmpty())
                        <small>おすすめユーザは全員フォローしています。</small>
                    @elseif (!$hasSimilarUsers)
                        <small>おすすめユーザはいません。</small>
                    @else
                        <ul class="list-unstyled">
                            @foreach ($similarUsers as $user)
                                <li class="col-8 d-flex align-items-center justify-content-between mt-3">
                                    <div class="d-flex align-items-center">
                                        @if($user->avatar)
                                            <img class="rounded-circle image-fluid mr-3" src="{{ Storage::url($user->avatar) }}" alt="プロフィール画像" style="width: 30px; height: 30px;">
                                        @else
                                            <img class="rounded-circle image-fluid mr-3" src="{{ Gravatar::src($user->email, 30) }}" alt="アバター画像">
                                        @endif
                                        <p class="mb-0">
                                            <a href="{{ route('user.show', $user->id) }}" class="text-decoration-none text-dark">{{ $user->name }}</a>
                                        </p>
                                    </div>
                                    <div class="mt-3">
                                        <form method="POST" action="{{ route('follow', $user->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-light border rounded-circle p-2">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</div>