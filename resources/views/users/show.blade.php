@extends('layouts.app')
@section('content')
    <div class="row">
        <aside class="col-sm-4 mb-5">
            <div class="card bg-info">
                <div class="card-header">
                    <h3 class="card-title text-light">{{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    <img class="rounded-circle img-fluid" src="{{ Gravatar::src($user->email, 400) }}" alt="ユーザのアバター画像">
                    @if (Auth::id() === $user->id)
                        <div class="mt-3">
                            <a href="" class="btn btn-primary btn-block">ユーザ情報の編集</a>
                            {{-- ユーザ退会ボタンあとで削除ここから↓ --}}
                            <a class="btn btn-danger text-light" data-toggle="modal" data-target="#deleteConfirmModal">退会する</a>
                            <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4>確認</h4>
                                        </div>
                                        <div class="modal-body">
                                            <label>本当に退会しますか？</label>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-between">
                                            <form action="{{ route('user.delete', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">退会する</button>
                                            </form>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- ユーザ退会ボタンあとで削除ここまで↑ --}}
                        </div>
                    @endif
                </div>
            </div>
        </aside>
        <div class="col-sm-8">
            <ul class="nav nav-tabs nav-justified mb-3">
                <li class="nav-item"><a href="{{ route('user.show', $user->id) }}"
                        class="nav-link {{ Request::is('users/' . $user->id) ? 'active' : '' }}">タイムライン</a></li>
                <li class="nav-item"><a href="#" class="nav-link">フォロー中</a></li>
                <li class="nav-item"><a href="#" class="nav-link">フォロワー</a></li>
            </ul>
            @foreach ($posts as $post)
                <ul class="list-unstyled">
                    <li class="mb-3 text-center">
                        <div class="text-left d-inline-block w-75 mb-2">
                            <img class="mr-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 55) }}"
                                alt="ユーザのアバター画像">
                            <p class="mt-3 mb-0 d-inline-block">
                                <a href="{{ route('user.show', $post->user_id) }}">{{ $post->user->name }}</a>
                            </p>
                        </div>
                        <div class="text-left d-inline-block w-75">
                            <p class="mb-2">{{ $post->content }}</p>
                            <p class="text-muted">{{ $post->created_at }}</p>
                        </div>
                        @if (Auth::id() === $post->user_id)
                            <div class="d-flex justify-content-between w-75 pb-3 m-auto">
                                <form action="" method="" onsubmit="">
                                    <button type="submit" class="btn btn-danger">削除</button>
                                </form>
                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">編集する</a>
                            </div>
                        @endif
                    </li>
                </ul>
            @endforeach
            <div class="m-auto" style="width: fit-content">
                {{ $posts->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
