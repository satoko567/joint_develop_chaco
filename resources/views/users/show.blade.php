@extends('layouts.app')
@section('content')
@include('components.flash_message')
<div class="row">
    <aside class="col-sm-4 mb-5">
        <div class="card bg-info">
            <div class="card-header">
                <h3 class="card-title text-light">{{$user->name}}</h3>
                @include('follow.follow_button', ['user' => $user])
            </div>
            <div class="card-body">
                <img class="rounded-circle" src="{{ Gravatar::src($user->email , 310) }}" alt="ユーザのアバター画像">
                    <div class="mt-3">
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-block">ユーザ情報の編集</a>
                    </div>
            </div>
        </div>
    </aside>
    <div class="col-sm-8">
        <ul class="nav nav-tabs nav-justified mb-3">
            <li class="nav-item"><a href="{{ route('user.show', $user->id) }}" class="nav-link {{ Request::is('users/'. $user->id) ? 'active' : '' }}">タイムライン</a></li>
            <li class="nav-item"><a href="{{ route('user.follows', $user->id) }}" class="nav-link {{ Request::is('users/'. $user->id. '/follows') ? 'active' : '' }}">フォロー中 <div class="badge badge-secondary">{{ $countFollows }}</div></a></li>
            <li class="nav-item"><a href="{{ route('user.followers', $user->id) }}" class="nav-link {{ Request::is('users/'. $user->id. '/followers') ? 'active' : '' }}">フォロワー <div class="badge badge-secondary">{{ $countFollowers }}</div></a></li>
        </ul>
        {{-- 各タブの表示内容 --}}
        @if (Request::is('users/'. $user->id))
            @include('posts.posts', ['posts' => $posts])
        @elseif (Request::is('users/' . $user->id . '/follows'))
            {{-- フォロー中のユーザー一覧 --}}
            @foreach ($follows as $follow)
                <div class="media mb-3">
                    <img class="mr-3 rounded-circle" src="{{ Gravatar::src($follow->email, 70) }}" alt="アイコン">
                    <div class="media-body">
                        <h5 class="mt-0">
                            <a href="{{ route('user.show', $follow->id) }}">{{ $follow->name }}</a>
                        </h5>
                        @if (Auth::check() && Auth::id() !== $follow->id)
                            @include('follow.follow_button', ['user' => $follow])
                        @endif
                    </div>
                </div>
            @endforeach
        @elseif (Request::is('users/'. $user->id. '/followers'))
            {{-- フォロワーの一覧表示 --}}
            @foreach ($followers as $follower)
                <div class="media mb-3">
                    <img class="mr-3 rounded-circle" src="{{ Gravatar::src($follower->email, 70) }}" alt="アイコン">
                    <div class="media-body">
                        <h5 class="mt-0">
                            <a href="{{ route('user.show', $follower->id) }}">{{ $follower->name }}</a>
                        </h5>
                        @if (Auth::check() && Auth::id() !== $follower->id)
                            @include('follow.follow_button', ['user' => $follower])
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection