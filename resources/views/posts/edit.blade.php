@extends('layouts.app')
@section('content')

<h2 class="mt-5">投稿内容を編集する</h2>
<form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="content">投稿内容</label>
        <textarea id="content" class="form-control" name="content" rows="5">{{ old('content', $post->content) }}</textarea>
        @error('content')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group mt-3">
        <input type="file" name="image" id="image" class="form-control-file">
        <small class="form-text text-muted">変更する画像を選択</small>
        @error('image')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    @if ($post->image_path)
    <section class="img-edit mt-4">
        <label>現在の画像</label>
        <div class="card p-3">
            <img alt="投稿画像" class="img-thumbnail clickable-image" src="{{ asset('storage/' . $post->image_path) }}"
                style="max-width: 300px; width: 100%; height: auto; cursor: pointer;"
                data-image="{{ asset('storage/' . $post->image_path) }}">
        </div>
    </section>
    @endif

    <button type="submit" class="btn btn-primary mt-4">更新する</button>
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