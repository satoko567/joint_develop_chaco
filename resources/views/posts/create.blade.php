@extends('layouts.app')
@section('title', '投稿フォーム | クルマの名医ナビ')
@section('meta_description', '整備工場のおすすめ情報を投稿できるページです。実際に利用した体験をもとに、接客・価格・技術などのレビューを共有しましょう。')
@section('content')
    <div class="container mt-4 mb-5">
        <h2 class="text-center mb-4"><i class="fas fa-wrench mr-1"></i>整備工場を投稿する</h2>
        @include('commons.error_messages')
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group w-75 mb-3">
                <label for="shop_name" class="form-label">
                    整備工場名 <span class="text-danger small">※</span>
                </label>
                <input type="text" id="shop_name" name="shop_name" class="form-control" value="{{ old('shop_name') }}">
            </div>
            <div class="form-group w-75 mb-3">
                <label for="address" class="form-label">
                    住所 <span class="text-danger small">※</span>
                </label>
                <input type="text" id="address" name="address" class="form-control" value="{{ old('address') }}">
            </div>
            <div class="form-group mb-3">
                <label for="content" class="form-label">
                    おすすめポイント <span class="text-danger small">※</span>
                </label>
                <textarea id="content" name="content" class="form-control" rows="5" placeholder="例：接客・対応、料金、修理の仕上がりなど">{{ old('content') }}</textarea>
            </div>
            <div class="form-group w-75 mb-4">
                <label for="tags" class="form-label">タグ（※任意 カンマ区切りで入力）</label>
                <input type="text" name="tags" class="form-control"
                    value="{{ old('tags') ? str_replace('，', ',', old('tags')) : '' }}" placeholder="例：修理、車検、整備">
                <small class="text-muted">
                    ※ タグは最大10個まで、1つのタグは20文字以内で入力してください。<br>
                    ※ 全角カンマ（、）や読点（，）で区切っても自動で登録されます。<br>
                    ※「#」を入れなくても登録されます。
                </small>
            </div>
            <div class="form-group mb-4">
                <label for="image" class="form-label">画像をアップロード（※任意）</label>
                <input type="file" id="image" name="image" class="form-control-file">
            </div>
            <div class="text-left">
                <button type="submit" class="btn btn-primary">投稿する</button>
            </div>
            <input type="hidden" name="lat" id="lat">
            <input type="hidden" name="lng" id="lng">
        </form>
    </div>
    <div class="container mb-5">
        <h4 class="text-center fw-bold mb-4">
            <i class="fas fa-clock me-2 text-secondary"></i> 新着投稿
        </h4>
        @include('posts.posts', ['posts' => $posts, 'keyword' => $keyword])
    </div>
@endsection
@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.GoogleMapsApiKey') }}&libraries=places"></script>
    <script src="{{ asset('js/geocode.js') }}"></script>
@endsection