@extends('layouts.app')

@section('content')

<h2 class="mt-5">投稿を編集する</h2>
    <form method="POST" action="{{ route('posts.update', $post->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <textarea id="content" class="form-control" name="content" rows="5">{{ old('content', $post->content) }}</textarea>
                @error('content')
                <p class="text-danger">{{ $message }}</p>
                @enderror
        </div>
        <button type="submit" class="btn btn-primary">更新する</button>
    </form>

    <section class="img-edit">
        <h2 class="mt-5">画像を編集する</h2>
        @foreach ($post->images as $image)
            <img alt="投稿画像" class="img-thumbnail clickable-image my-2" src="{{ asset('storage/' . $image->image_path) }}" style="width: 200px; cursor: pointer;" data-image="{{ asset('storage/'. $image->image_path) }}">
                <form method="POST" action="{{ route('postImages.update', $image->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="file" name="image" accept="image/*" class="form-control mb-1">
                    <button type="submit" class="btn btn-warning">画像を変更</button>
                </form>
                <form method="POST" action="{{ route('postImages.destroy', $image->id)}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">画像を削除</button>
                </form>
        @endforeach
        <a class="btn btn-secondary mt-3" href="/">トップページへ</a>
        </section>
@endsection

<!-- モーダル -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img id="modalImage" src="" alt="拡大画像" class="img-fluid">
            </div>
        </div>
    </div>
</div>
