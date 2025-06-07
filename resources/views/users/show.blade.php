@extends('layouts.app')

@section('content')    
    <div class="row">
        <aside class="col-sm-4 mb-5">
            <div class="card bg-info">
                <div class="card-header">
                    <h3 class="card-title text-light">{{ $user->name }}</h3>
                </div>
                <div class="card-body text-center">
                    <img class="rounded-circle img-fluid" src="{{ Gravatar::src($user->email, 300) }}" alt="ユーザのアバター画像">
                    
                    <div class="mt-3">
                        {{-- 自分のプロフィールなら編集ボタン --}}
                        @if($user->id == Auth::id())
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-block">ユーザ情報の編集</a>
                        @endif 

                        {{-- 他人のプロフィールならフォローボタン --}}
                        @if(Auth::id() != $user->id)
                            @if (Auth::user()->isFollowing($user->id))
                                <form method="POST" action="{{ route('unfollow', $user->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-block">フォロー解除</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('follow', $user->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-block">フォローする</button>
                                </form>
                            @endif
                        @endif

                        {{-- フォロー・フォロワーの数 --}}
                        <div class="mt-3 text-light">
                            <p>フォロー中：<a href="{{ route('users.followings', $user->id) }}" class="text-white">{{ $user->followings()->count() }}</a></p>
                            <p>フォロワー：<a href="{{ route('users.followers', $user->id) }}" class="text-white">{{ $user->followers()->count() }}</a></p>
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

            {{-- 投稿一覧（タイムライン） --}}
            @include('posts.posts', ['posts' => $user->posts()->paginate(10), 'keyword' => $keyword])
        </div>
    </div>
@endsection