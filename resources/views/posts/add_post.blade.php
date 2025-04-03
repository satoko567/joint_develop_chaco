<div class="text-center mb-3">
    <form method="POST" action="{{ route('post.store') }}" class="d-inline-block w-75" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <textarea class="form-control" name="content">{{ old('content') }}</textarea>
            <div class="form-group">
                <label for="image">画像</label>
                <input type="file" name="image" class="form-control-file">
            </div>
            @error('content')
            <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="text-left mt-3">
                <button type="submit" class="btn btn-primary">投稿する</button>
            </div>
        </div>
    </form>
</div>