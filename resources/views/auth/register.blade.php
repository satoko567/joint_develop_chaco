@extends('layouts.app')
@section('content')

<section class="title mt-5 d-flex flex-column align-items-center">
    <div class="d-flex justify-content-center align-items-center">
        <img class="w-50 mb-3 mx-auto d-block" src="{{ asset('images/top.png') }}" alt="トップ画像">
    </div>
    <div class="mt-3 text-start w-50 fs-5">
        <p class="">新規ユーザ登録すると投稿で <br>
            コミュニケーションができるようになります。</p>
    </div>
</section>

<section class="mt-5 mb-5 d-flex flex-column align-items-center">
    <h2 class="fst-normal">新規ユーザ登録</h2>
    <form method="POST" action="{{route('signup.post')}}" class="d-flex flex-column align-items-center w-50 mt-4">
        @csrf
        <div class="w-100 text-start mt-2">
            <label class="form-label">名前</label> <br>
            <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control col-auto">
            @error('name')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-100 text-start mt-2">
            <label class="form-label">メールアドレス</label> <br>
            <input type="text" name="email" id="email" value="{{old('email')}}" class="form-control col-auto">
            @error('email')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-100 text-start mt-2">
            <label class="form-label">パスワード</label> <br>
            <div class="d-flex input-group">
                <input type="password" name="password" id="password" value="{{old('password')}}" class="form-control col-auto">
                <button type="button" class="btn btn-outline-secondary" data-toggle="password">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            @error('password')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-100 text-start mt-2">
            <label class="form-label">パスワード確認</label> <br>
            <div class="d-flex input-group">
                <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}" class="form-control col-auto">
                <button type="button" class="btn btn-outline-secondary" data-toggle="password">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            @error('password')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mt-3 align-self-start" onclick="registerModal()" data-bs-toggle="modal" data-bs-target="#exampleModal">
            登録する
        </button>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-3" id="exampleModalLabel">ユーザを登録します。</h1>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <li class="list-group-item my-2">名前: <span class="mx-2" id="confirm-name"></span></li>
                            <li class="list-group-item my-2">メールアドレス: <span class="mx-2" id="confirm-email"></span></li>
                            <li class="list-group-item my-2">パスワード: <span class="mx-2" id="confirm-password"></span></li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                        <button type="submit" class="btn btn-primary">登録する</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</section>

@endsection