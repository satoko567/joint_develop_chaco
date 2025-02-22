@extends('layouts.app')
@section('content')
<div class="row">
    @include('commons.userCard')
    <div class="col-sm-8">
        <!-- ナビゲーションタブ -->
        @include('commons.navigation')
        <!-- Followingを表示 -->
        @include('follow.following')
        @if($user->icon && Storage::disk('public')->exists('icons/'. $user->icon)) 
            <img src="{{ asset('storage/icons/'.$user->icon) }}" alt="ユーザーアイコン" class="rounded-circle img-fluid" width="55">
        @else
            <img class="mr-2 rounded-circle" src="{{ Gravatar::src($user->email, 55) }}" alt="ユーザのアバター画像">
        @endif 
            <a href="{{ route('users.show', $activity->user->id) }}">
                {{ $activity->user->nickname }}
            </a>
    </div>
</div>
@endsection