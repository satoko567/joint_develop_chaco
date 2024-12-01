@extends('layouts.app')
@section('content')
<div class="row">
    <aside class="col-sm-4 mb-5">
        <div class="card bg-info">
            <div class="card-header">
                <h3 class="card-title text-light">{{ $user->name }}</h3>
                @include('follow.follow', ['user' => $user])
            </div>
            <div class="card-body">
                <img class="rounded-circle img-fluid" src="{{ Gravatar::src($user->email, 400) }}" alt="ユーザのアバター画像">
                <div class="mt-3">
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-block">ユーザ情報の編集</a>
                </div>
            </div>
        </div>
    </aside>
    <div class="col-sm-8">
        <ul class="nav nav-tabs nav-justified mb-3">
            <li class="nav-item"><a href="{{ route('user.show', $user->id) }}" class="nav-link {{ Request::is('users/'. $user->id) ? 'active' : '' }}">タイムライン</a></li>
            <li class="nav-item"><a href="{{ route('user.following', $user->id) }}" class="nav-link {{ Request::is('users/'. $user->id. '/tofollow') ? 'active' : '' }}">フォロー中 {{ $countFollowing }}人</a></li>
            <li class="nav-item"><a href="{{ route('user.followed', $user->id) }}" class="nav-link {{ Request::is('users/'. $user->id. '/unfollow') ? 'active' : '' }}">フォロワー {{ $countFollowed }}人</a></li>
        </ul>
        @if ($follow_if === 1)
            @include('follow.users_follow')
        @else
            @include('posts.posts', ['user' => $user, 'posts' => $posts])
        @endif
    </div>
</div>
@endsection