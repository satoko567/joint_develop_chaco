@extends('layouts.app')

@section('content')

<h2 class="mt-5">投稿内容を編集する</h2>
<form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <textarea id="content" class="form-control" name="content" rows="5">{{ old('content', $post->content) }}</textarea>
    </div>

<!-- 投稿エラー -->
    @error('content')
    <p class="text-danger">{{ $message }}</p>
@enderror
<!-- 画像複数枚投稿エラー -->
@error('new_images')
    <p class="text-danger">{{ $message }}</p>
@enderror
<!-- 画像1枚に対してのエラー -->
@for ($i = 0; $i < 4; $i++)
    @error("new_images.$i")
        <p class="text-danger">{{ $message }}</p>
    @enderror
@endfor
<!-- 画像削除エラー -->
@foreach ($post->images as $image)
    @error("delete_images.{$loop->index}")
        <p class="text-danger">{{ $message }}</p>
    @enderror
@endforeach

    <section class="img-edit">
        @foreach ($post->images as $image)
        <div class="my-3 card p-3">
            <img alt="投稿画像" class="img-thumbnail clickable-image my-1" src="{{ asset('storage/' . $image->image_path) }}" style="width: 200px; cursor: pointer;" data-image="{{ asset('storage/'. $image->image_path) }}">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="delete_images[]" value="{{ $image->id }}" id="delete_{{ $image->id }}">
                <label class="form-check-label" for="delete_{{ $image->id }}">削除する</label>
            </div>
            <input type="file" name="images[{{ $image->id }}]" class="form-control-file mb-1">
        </div>
        @endforeach

        <section class="img-add my-4 card p-3">
            <h4>新しい画像を追加する</h4>
            <input type="file" name="new_images[]" multiple class="form-control-file">
            <small class="form-text text-muted">複数枚選択できます</small>
        </section>

    </section>

    <button type="submit" class="btn btn-primary">更新する</button>
</form>
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