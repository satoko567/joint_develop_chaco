@extends('layouts.app')
@section('title', '投稿を編集')
@section('content')
    <div class="container mt-4 mb-5">
        <h2 class="text-center mb-4"><i class="fas fa-edit mr-1"></i>投稿内容を編集する</h2>
        @include('commons.error_messages')
        <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group w-75 mb-3">
                <label for="shop_name" class="form-label">整備工場名</label>
                <input type="text" id="shop_name" name="shop_name" class="form-control" 
                       value="{{ old('shop_name', $post->shop_name) }}">
            </div>
            <div class="form-group w-75 mb-3">
                <label for="address" class="form-label">住所</label>
                <input type="text" id="address" name="address" class="form-control" 
                       value="{{ old('address', $post->address) }}">
            </div>
            <div class="form-group mb-3">
                <label for="content" class="form-label">おすすめポイント</label>
                <textarea id="content" name="content" class="form-control" rows="5" 
                          placeholder="例：接客・対応、料金、修理の仕上がりなど">{{ old('content', $post->content) }}</textarea>
            </div>
            @if ($post->image)
                <div class="mb-3">
                    <p>現在の画像：</p>
                    <img src="{{ asset('storage/' . $post->image) }}" alt="投稿画像" style="max-width: 200px;">
                </div>
            @endif
            <div class="form-group mb-4">
                <label for="image" class="form-label">画像を変更する（任意）</label>
                <input type="file" id="image" name="image" class="form-control-file">
            </div>
            <div class="text-left">
                <button type="submit" class="btn btn-primary">更新する</button>
            </div>
            <input type="hidden" name="lat" id="lat" value="{{ old('lat', $post->lat) }}">
            <input type="hidden" name="lng" id="lng" value="{{ old('lng', $post->lng) }}">
        </form>
    </div> 
@endsection

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>
    <script src="{{ asset('js/geocode.js') }}"></script>
@endsection