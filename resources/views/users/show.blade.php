@extends('layouts.app')
@section('content')
<div class="row">
    @include('commons.userCard')
    <div class="col-sm-8">
        <!-- ナビゲーションタブ -->
        @include('commons.navigation')
        <!-- ユーザーの投稿を表示 -->
        @include('timeline.timeline')
    </div>
</div>
@endsection