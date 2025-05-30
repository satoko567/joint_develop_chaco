@extends('layouts.app') {{-- 動作確認後 このファイルを削除 --}}

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <aside class="col-sm-4 mb-5">
            <div class="card bg-info">
                <div class="card-header">
                    <h3 class="card-title text-light">{{ $user->name }}</h3>
                </div>
                <div class="text-center">
                    <img class="rounded-circle img-fluid mb-3" src="{{ Gravatar::src($user->email, 300) }}" alt="{{ $user->name }}">

                    {{-- ▼▼▼ ここにフォローボタンを差し込む ▼▼▼ --}}
                    @if (Auth::check() && Auth::id() !== $user->id)
                        @include('follow.follow_button', ['user' => $user])
                    @endif
                    {{-- ▲▲▲ 差し込みここまで ▲▲▲ --}}

                    <div class="mt-3">
                        {{-- 自分のプロフィールの場合だけ編集ボタン表示 --}}
                        @if (Auth::id() === $user->id)
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-block">ユーザ情報の編集</a>
                        @endif
                    </div>
                </div>
            </div>
        </aside>

        <div class="col-sm-8">
            <ul class="nav nav-tabs nav-justified mb-3">
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::is('users/' . $user->id) ? 'active' : '' }}">タイムライン</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">フォロー中</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">フォロワー</a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection