{{-- ユーザ詳細ページ --}}
@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row">
        <aside class="col-sm-4 mb-5">
            <div class="card bg-info">
                <div class="card-header">
                    <h3 class="card-title text-light">{{$user->name}}</h3>
                </div>
                <div class="card-body">
                    <img class="rounded-circle img-fluid" src="{{ Gravatar::src($user->email, 100) }}" alt="ユーザのアバター画像">
                    <div class="mt-3">
                        <a href=""></a> {{-- ユーザ編集画面へのリンク。rikoさんに書いてもらうか、ルートネーム教えてもらって書くか、相談して決める必要 --}}
                    </div>
                </div>
            </div>
        </aside>
        <div class="col-sm-8">
            <ul class="nav nav-tabs nav-justified mb-3">
                <li class="nav-item"><a href="{{ route('users.show', $user->id) }}" class="nav-link {{ Request::is('users/'. $user->id) ? 'active' : '' }}">タイムライン</a></li>
                <li class="nav-item"><a href="#" class="nav-link {{ Request::is('users/'. $user->id. '#') ? 'active' : '' }}">フォロー中</a></li>
                <li class="nav-item"><a href="##" class="nav-link {{ Request::is('users/'. $user->id. '##') ? 'active' : '' }}">フォロワー</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection