{{-- @extends('layouts.app')
@section('content')  layouts.appがマージされたら、コメントアウトを外す--}}
    <div class="container mt-5 mb-5">
        <div class="mx-auto" style="max-width: 1150px;">
            <h2 class="mt-5 mb-3">ユーザ情報を編集する</h2>
            @if (count($errors) > 0)
                <ul class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        <li class="ml-4">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            {{-- error_messagesがマージされたら、@include('commons.error_messages')へ変更 --}}
            <form method="POST" action="{{ route('user.update', $user->id) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $user->id }}" />
                <div class="form-group">
                    <label for="name">ユーザ名</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name', $user->name) }}"/>
                </div>

                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input class="form-control" type="email" name="email" value="{{ old('email', $user->email) }}" />
                </div>

                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input class="form-control" type="password" name="password" />
                </div>

                <div class="form-group">
                    <label for="password_confirmation">パスワードの確認</label>
                    <input class="form-control" type="password" name="password_confirmation" />
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
                            <form action="" method="POST">
                                <button type="submit" class="btn btn-danger">退会する</button>
                            </form>
                            <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-5"></div>
{{-- @endsection --}}