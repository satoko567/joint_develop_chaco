@extends('layouts.app')
@section('content')
<div class="center">
    <img class="w-50 mb-3 mx-auto d-block" src="{{ asset('images/admin_top.png') }}" alt="トップ画像">
</div>

<button type="button" class="btn btn-secondary">ユーザ管理</button>
<button type="button" class="btn btn-secondary">投稿管理</button>
<button type="button" class="btn btn-secondary">リプライ管理</button>

@endsection