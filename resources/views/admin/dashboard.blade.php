@extends('layouts.app')
@section('content')
<div class="center">
    <img class="w-50 mb-5 mx-auto d-block" src="{{ asset('images/admin_top.png') }}" alt="トップ画像">
</div>
<div class="d-flex justify-content-center">
    <a href="{{ route('admin.show.users') }}" class="btn btn-secondary">ユーザ編集</a>
    <a href="{{ route('admin.show.posts') }}" class="btn btn-secondary mx-3">投稿編集</a>
    <a href="{{ route('admin.show.replies') }}" class="btn btn-secondary">リプライ編集</a>
</div>

@endsection