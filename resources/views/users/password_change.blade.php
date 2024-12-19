@extends('layouts.app')

@section('content')
<div class="container w-50">
    {{-- Error Messages --}}
    @include('commons.error_messages')
    <h2>パスワード変更</h2>

    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="current_password" class="form-label">現在のパスワード</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>

        <div class="mb-3">
            <label for="new_password" class="form-label">新しいパスワード</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">新しいパスワード（確認）</label>
            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary">変更する</button>
    </form>
</div>
@endsection