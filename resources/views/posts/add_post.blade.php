<div class="text-center mb-3">
    <form method="POST" action="{{ route('post.store') }}" class="d-inline-block w-75"enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <textarea class="form-control" name="content">{{ old('content') }}</textarea>
            <div class="form-group">
                <input type="file" name="images[]" multiple class="form-control-file">
            </div>
            @error('content')
            <p class="text-danger">{{ $message }}</p>
            @enderror

            @error('images')
            <p class="text-danger">{{ $message }}</p>
            @enderror

            @if ($errors->has('images.*'))
                @foreach ($errors->get('images.*') as $error)
                    <p class="text-danger">{{ $error[0] }}</p>
                @endforeach
            @endif

            <div class="text-left mt-3">
                <button type="submit" class="btn btn-primary">投稿する</button>
            </div>
        </div>
    </form>
</div>