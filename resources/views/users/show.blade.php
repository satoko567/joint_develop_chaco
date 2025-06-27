@extends('layouts.app')
@section('title', $user->name . 'さんのプロフィール | クルマの名医ナビ')
@section('meta_description', $user->name . 'さんのタイムラインとフォロー関係を閲覧できます。気になる整備工場やユーザーを見つける参考にどうぞ。')
@section('content')    
    <div class="row">
        <aside class="col-sm-4 mb-5">
            <div class="card bg-dark text-white shadow rounded">
                <div class="card-header d-flex align-items-center justify-content-center" style="background-color: #495057; height: 60px; color: white; letter-spacing: 1px; font-weight: bold;">
                    <h3 class="card-title text-light mb-1">{{ $user->name }}</h3>
                </div>
                <div class="card-body text-center">
                    <img class="rounded-circle img-fluid border border-light" src="{{ Gravatar::src($user->email, 300) }}" alt="ユーザのアバター画像">
                    <div class="mt-3">
                        @if($user->id == Auth::id())
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary w-50 mb-2">ユーザ情報の編集</a>
                        @endif 
                        @include('follow.follow_button', ['user' => $user])                
                        <div class="d-flex justify-content-center text-light" style="gap: 4rem; margin-top: 1rem;">
                            <div class="text-center" style="min-width: 100px;">
                                <a href="{{ route('users.followings', $user->id) }}" class="text-white text-decoration-none">
                                    <strong style="font-size: 1.4rem;">{{ number_format($user->followings()->count()) }}</strong><br>
                                    <span style="font-size: 1.1rem;">フォロー中</span>
                                </a>
                            </div>
                            <div class="text-center" style="min-width: 100px;">
                                <a href="{{ route('users.followers', $user->id) }}" class="text-white text-decoration-none">
                                    <strong style="font-size: 1.4rem;">{{ number_format($user->followers()->count()) }}</strong><br>
                                    <span style="font-size: 1.1rem;">フォロワー</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <div class="col-sm-8">
            <ul class="nav nav-tabs nav-justified mb-3">
                <li class="nav-item">
                    <a href="{{ route('user.show', $user->id) }}" class="nav-link {{ Request::is('users/'.$user->id) ? 'active' : '' }}">
                        タイムライン
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.followings', $user->id) }}" class="nav-link {{ Request::is('users/'.$user->id.'/followings') ? 'active' : '' }}">
                        フォロー中
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.followers', $user->id) }}" class="nav-link {{ Request::is('users/'.$user->id.'/followers') ? 'active' : '' }}">
                        フォロワー
                    </a>
                </li>
            </ul>
            @include('posts.posts', ['posts' => $posts, 'keyword' => $keyword])
        </div>
    </div>
@endsection