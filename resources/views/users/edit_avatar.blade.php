@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">アイコンの変更</h2>

    @include('components.flash_message')

    <div class="card mt-4 custom-card">
        <div class="card-body">
            <form action="{{ route('user.avatar.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="text-center mb-4">
                    {{-- プレビュー用アイコン画像 --}}
                    <img id="preview" src="{{ $user->avatar_image_url }}" class="avatar-preview" alt="現在のアイコン">

                    {{-- 写真アイコンとファイル名表示 --}}
                    <div class="mt-2">
                        <div class="mb-2">画像を選択</div>
                        {{-- ファイル選択ラベル --}}
                        <label for="image" class="image-label">
                            <img src="{{ asset('images/icons/写真アイコン4.png') }}" alt="画像を選択" class="image-icon">
                        </label>

                        {{-- ファイル名表示 --}}
                        <span id="file-name" class="ml-2 text-muted">未選択</span>
                    </div>

                    {{-- 非表示のファイル選択 --}}
                    <input type="file" name="avatar" id="image" class="d-none" accept="image/*">

                    @error('avatar')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">変更を保存</button>
                </div>
            </form>
            @push('scripts')
            <script>
                document.getElementById('image').addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    const preview = document.getElementById('preview');
                    const fileNameLabel = document.getElementById('file-name');

                    if (file) {
                        // ファイル名表示
                        fileNameLabel.textContent = file.name;

                        // プレビュー表示
                        const reader = new FileReader();
                        reader.onload = function (event) {
                            preview.src = event.target.result;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        fileNameLabel.textContent = '未選択';
                    }
                });
            </script>
            @endpush
        </div>
    </div>
</div>
@endsection