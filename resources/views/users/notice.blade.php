@extends('layouts.app')
@section('content')
<div class="row">
    @include('commons.userCard')
    <div class="col-sm-8">
        <!-- ナビゲーションタブ -->
        @include('commons.navigation')
        <!-- Followingを表示 -->
        @include('posts.notice')
    </div>
</div>
@endsection