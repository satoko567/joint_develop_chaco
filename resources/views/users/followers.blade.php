@extends('layouts.app')
@section('content')
<div class="row">
    @include('commons.userCard')
    <div class="col-sm-8">
        <!-- ナビゲーションタブ -->
        @include('commons.navigation')
        <!-- Followersを表示 -->
        @include('follow.followers')
    </div>
</div>
@endsection