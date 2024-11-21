@extends('layouts.app')
@section('content')
<h2 class="mt-5 mb-3">ユーザ情報を編集する</h2>
    <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
        {{-- Error Messages --}}
        @include('commons.error_messages')
        @csrf
        @method('PUT')
        <div style="display: flex; justify-content: space-between; gap: 20px; padding: 20px;"> 
            <div style="flex: 1; max-width: 60%; padding-right: 20px;">
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
                    <label for="password">パスワード</label>
                    <input class="form-control" type="password" name="password" />
                </div>

                <div class="form-group">
                    <label for="password_confirmation">パスワードの確認</label>
                    <input class="form-control" type="password" name="password_confirmation" />
                </div>
            </div>
            <div style="flex: 0 0 30%; display: flex; flex-direction: column; align-items: center; gap: 10px;">
                <div>
                    <label for="avatar" >プロフィール画像</label>
                    <input type="file" name="avatar" id="avatar" style="padding: 8px;">
                </div>
                @if($user->avatar)
                <div>
                    <img src="{{ Storage::url($user->avatar) }}" alt="現在のプロフィール画像" style="border-radius: 50%; object-fit: cover; width: 150px; height: 150px;">
                </div>
                @else
                <div class="card-body">
                    <img class="rounded-circle img-fluid" src="{{ Gravatar::src($user->email, 200) }}" alt="ユーザのアバター画像">
                </div>
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <a class="btn btn-danger text-light" data-toggle="modal" data-target="#deleteConfirmModal">退会する</a>
            
            <button type="submit" class="btn btn-primary">更新する</button>
        </div>
    </form>

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
