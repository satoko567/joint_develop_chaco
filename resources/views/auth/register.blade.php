{{-- @extends('layouts.app') --}}
{{-- @section('content') --}}
<section class="title mt-5 d-flex flex-column align-items-center">
    <div class="d-flex justify-content-center align-items-center">
        <i class="bi bi-send" style="font-size: 2rem;"></i>
        <h1 class="ms-3 fs-1 fw-bold">Topic Post</h1>
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
            <input type="text" name="name" value="{{old('name')}}" class="form-control col-auto">
            @error('name')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-100 text-start mt-2">
            <label class="form-label">メールアドレス</label> <br>
            <input type="text" name="email" value="{{old('email')}}" class="form-control col-auto">
            @error('email')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-100 text-start mt-2">
            <label class="form-label">パスワード</label> <br>
            <div class="d-flex input-group">
                <input type="password" name="password" value="{{old('password')}}" class="form-control col-auto">
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
        <button type="submit" class="btn btn-primary mt-3 align-self-start">新規登録</button>
    </form>
</section>

{{-- @endsection --}}