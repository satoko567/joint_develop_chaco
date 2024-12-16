@extends('layouts.app')
@section('content')
@include('commons.flash_message')
@yield('scripts')

<h2 class="mt-5 mb-3">ユーザ情報を編集する</h2>
<!-- プロフィール画像 -->
<div class="row">
    <div class="col-md-4 text center">
        <div class="d-flex flex-column align-items-center">
            <label for="avatar" style="margin: 10px;">プロフィール画像</label>
            
        @if($user->avatar)
            <div class="mt-3">
                <img src="{{ Storage::url($user->avatar) }}" alt="現在のプロフィール画像" style="border-radius: 50%; object-fit: cover; width: 300px; height: 300px;">
                <form method="POST" action="{{ route('profile.avatar.delete') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="margin: 31px;">画像を削除</button>
                </form>
            </div>
        @else
            <div class="card-body">
                <img class="rounded-circle img-fluid" src="{{ Gravatar::src($user->email, 300) }}" alt="ユーザのアバター画像">
            </div>
        @endif
    </div>
</div>
<!-- ユーザ情報 -->
<div class="col-md-8">
    <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
        {{-- Error Messages --}}
        @include('commons.error_messages')
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="avatar">新しいプロフィール画像</label><br>
            <input type="file" name="avatar" id="avatar">
        </div>
    
        <input type="hidden" name="id" value="{{ old('id', $user->id) }}" />
        <div class="form-group">
            <label for="name">ユーザ名</label>
            <input class="form-control" value="{{ old('name', $user->name) }}" name="name" />
        </div>

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input class="form-control" value="{{ old('email', $user->email) }}" name="email" />
        </div>

        <div class="form-group">
            <label for="profile">プロフィール文</label>
            <textarea class="form-control" name="profile" rows="4">{{ old('profile', $user->profile) }}</textarea>
            
        </div>
        <div class="d-flex justify-content-between">
            <a class="btn btn-danger text-light" data-toggle="modal" data-target="#deleteConfirmModal">退会する</a>
            <button type="submit" class="btn btn-primary">更新する</button>
        </div>
    </form>
</div>
    
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>確認</h4>
                </div>
                <div class="modal-body">
                    <label>本当に退会しますか？</label>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <form action="{{ route('user.delete', $user->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">退会する</button>
                    </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
