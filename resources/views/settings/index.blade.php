@extends('layouts.app')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <!-- 設定カード -->
    <div class="card w-50 shadow p-2 border-0" style="border-radius: 10px; background: #f9f9f9;">
            <h2 class="text-center">Settings</h2>
            <ul class="list-group list-group-flush">
                <!-- ユーザー情報編集 -->
                <li class="list-group-item d-flex align-items-center" style="border: none;">
                    <i class="fas fa-user-edit fa-lg text-primary mr-3"></i>
                    <a href="{{ route('user.edit', Auth::id()) }}" class="text-decoration-none" style="color: #333; font-weight: 500;">ユーザー情報編集</a>
                </li>
                <!-- パスワード変更 -->
                <li class="list-group-item d-flex align-items-center" style="border: none;">
                    <i class="fas fa-lock fa-lg text-success mr-3"></i>
                    <a href="{{ route('password.change') }}" class="text-decoration-none" style="color: #333; font-weight: 500;">パスワード変更</a>
                </li>
                <!-- 退会する -->
                <li class="list-group-item d-flex align-items-center" style="border: none;">
                    <i class="fas fa-trash-alt fa-lg text-danger mr-3"></i>
                    <a href="#" class="text-decoration-none text-danger" style="font-weight: 500;">退会する</a>
                </li>
            </ul>
    </div>
</div>
@endsection

<style>
    .list-group-item:hover {
    background-color: #f0f0f0;
    cursor: pointer;
}
.list-group-item i:hover {
    transform: scale(1.1);
    transition: transform 0.2s ease-in-out;
}
</style>