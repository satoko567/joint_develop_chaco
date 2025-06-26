@extends('layouts.app')
@section('title', $user->name . 'さんをフォローしているユーザー一覧 | クルマの名医ナビ')
@section('meta_description', $user->name . 'さんがフォローしている整備工場やユーザーの一覧を確認できます。信頼できるおすすめの工場を探す参考にしましょう。')
@section('content')
    <div class="container mt-5">
        <h3>
        <a href="{{ route('user.show', $user->id) }}" class="text-dark fw-bold"
        style="text-decoration: none; transition: all 0.2s ease;"
        onmouseover="this.style.textDecoration='underline';"
        onmouseout="this.style.textDecoration='none';">
            {{ $user->name }}
        </a> さんをフォローしているユーザー
        </h3>
        <form method="GET" action="{{ route(Route::currentRouteName(), $user->id) }}" class="mx-auto mt-4 mb-5" style="max-width: 700px; width: 100%;">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                <input type="text" name="search" class="form-control" placeholder="名前で検索" value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">検索</button>
                </div>
            </div>
        </form>
        @include('users.users', ['users' => $users])
    </div>
@endsection