{{-- ユーザ詳細ページ --}}
{{-- @extends('layouts.app') まだlayouts.appがないのでコメントアウト。 --}}
{{-- @section('content') --}}
<div class="container">
    <div class="row">
        <aside class="col-sm-4 mb-5">
            <div class="card bg-info">
                <div class="card-header">
                    <h3 class="card-title text-light">{{$user->name}}</h3>
                </div>
                <div class="card-body">
                    <img class="rounded-circle img-fluid" src="{{ Gravatar::src($user->email, 55) }}" alt="ユーザのアバター画像">
                    <div class="mt-3">
                        <a href=""></a>
                    </div>
            </div>
        </aside>
        <div class="col-sm-8">
            <ul class="nav nav-tabs nav-justified mb-3">
                <li class="nav-item"><a href="{{ route('user.show', $user->id) }}" class="nav-link {{ Request::is('users/'. $user->id) ? 'active' : '' }}">タイムライン</a></li>
                <li class="nav-item"><a href="#" class="nav-link {{ Request::is('users/'. $user->id. '#') ? 'active' : '' }}">フォロー中</a></li>
                <li class="nav-item"><a href="##" class="nav-link {{ Request::is('users/'. $user->id. '##') ? 'active' : '' }}">フォロワー</a></li>
            </ul>
        </div>
    </div>
</div>
{{-- @endsection --}}