@extends('layouts.app')
@section('content')
@include('commons.flash_message')
@yield('scripts')
<div class="row">
    <aside class="col-sm-4 mb-5">
        <div class="card bg-info">
            <div class="card-header">
                <h3 class="card-title text-light">{{ $user->name }}</h3>
                {{-- Follow Button --}}
                @include('commons.follow_button',['user'=> $user])
            </div>
            <div class="card-body">
                <img class="rounded-circle img-fluid" src="{{ Gravatar::src($user->email, 400) }}" alt="ユーザのアバター画像">
                @auth
                    @if (Auth::id() === $user->id)
                        <div class="mt-3">
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-block">ユーザ情報の編集</a>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </aside>
    <div class="col-sm-8">
        <ul class="nav nav-tabs nav-justified mb-3">
            <li class="nav-item"><a href="{{ route('user.show', $user->id) }}" class="nav-link {{ Request::is('users/' . $user->id) ? 'active' : '' }}">タイムライン</a></li>
            <li class="nav-item"><a href="{{ route('users.followings', $user->id) }}" class="nav-link {{ Request::is('users/' . $user->id . '/followings') ? 'active' : '' }}">フォロー中 <span class="badge badge-primary">{{ $user->following()->count() }}</span></a></li>
            <li class="nav-item"><a href="{{ route('users.followers', $user->id) }}" class="nav-link {{ Request::is('users/' . $user->id . '/followers') ? 'active' : '' }}">フォロワー <span class="badge badge-primary">{{ $user->followers()->count() }}</span></a></li>
        </ul>
       
        @if (isset($posts))
             {{-- 投稿 --}}
            @include('posts.posts',['posts'=> $posts])
        @else 
            @include('commons.follow_list', ['users'=> $users, 'message'=> $message])
        @endif
    </div>
</div>
@endsection