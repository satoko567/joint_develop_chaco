@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>{{ $user->name }} さんがフォローしているユーザー</h3>

    {{-- ユーザー一覧を表示 --}}
    @include('users.users', ['users' => $users])
</div>
@endsection