<div class="text-center mb-3">
    <form method="POST" action="{{ route('post.store') }}" class="d-inline-block w-75" enctype="multipart/form-data">
        @csrf

        <div class="form-group text-left">
            <label for="content">投稿内容</label>
            <textarea id="content" class="form-control" name="content" rows="3">{{ old('content') }}</textarea>
            @error('content')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group text-left mt-3">
            <input type="file" name="image" id="image" class="form-control-file multiple">
            <small class="form-text text-muted">この投稿は画像の添付が必要です。</small>
            @error('image')
                <p class="text-danger mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="text-left mt-4">
            <button type="submit" class="btn btn-primary">投稿する</button>
        </div>
    </form>
</div>
