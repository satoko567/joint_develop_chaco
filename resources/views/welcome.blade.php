@extends('layouts.app')
@section('content')
@include('commons.flash_message')
@yield('scripts')
    <div class="row d-flex justify-content-between">
        @include('commons.left_sidebar')
        <!-- メインコンテンツ -->
        <div class="col-6 px-4">
            <div class="d-flex justify-content-center align-items-center">
                <div class="card w-100 shadow-sm border-secondary">
                    <div class="card-header bg-light text-dark text-center border-secondary">
                        <span class="message-title">
                            <i class="fas fa-code"></i> プログラミング学習記録
                        </span>
                        <span class="message-subtitle">
                            を140字以内でシェアしよう！
                        </span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('post.store') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <textarea
                                    class="form-control rounded-3 shadow-sm border-secondary"
                                    name="content"
                                    rows="3"
                                    placeholder="ここに投稿内容を入力..."></textarea>
                            </div>
                            <div class="d-flex btn-gradient">
                                <button type="submit" class="btn  w-100 px-4 py-1 mb-0 shadow-sm text-white">Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('posts.posts',['posts' => $posts, 'users' => $users])
        </div>
        @include('commons.right_sidebar')
    </div>
</div>
@endsection

<style>
.btn-gradient {
    background: linear-gradient(45deg, #2a0750, #1b50ab);
    border: none;
    font-weight: bold;
    transition: transform 0.3s ease, background 0.3s ease;
}

.btn-gradient:hover {
    background: linear-gradient(45deg, #1b50ab, #2a0750);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transform: scale(1.03); */
}

.message-title {
    font-weight: bold;
    font-size: 1.1em;
}
.message-subtitle {
    font-size: 1.1em;
}
</style>