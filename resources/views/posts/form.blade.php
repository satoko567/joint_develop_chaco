<div class="card mt-4 shadow-sm mx-auto" style="max-width: 800px;">
    <div class="card-body">
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <textarea name="content" id="content" class="form-control" rows="3" placeholder="いまどうしてる？">{{ old('content') }}</textarea>
            </div>

            {{-- タグ選択 --}}
            <div class="form-group mb-3 text-left">
                <label>タグを選択:</label><br>
                @foreach ($tags as $tag)
                    <label class="mr-3">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                            {{ (is_array(old('tags')) && in_array($tag->id, old('tags'))) ? 'checked' : '' }}>
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>
            {{-- 画像添付--}}
            <div class="form-group mb-3">
                <div class="d-flex align-items-center">
                    {{-- アイコン --}}
                    <label for="image" style="cursor: pointer;" class="mb-0 mr-2 d-flex align-items-center">
                        <img src="{{ asset('images/icons/写真アイコン4.png') }}" alt="画像を選択" style="width: 32px; height: 32px;">
                    </label>
                    {{-- ファイル名表示 --}}
                    <span id="file-name" class="text-muted" style="font-size: 0.9rem; line-height: 32px; height: 32px;"></span>
                </div>
                {{-- プレビュー画像 --}}
                <img id="preview" src="#" alt="画像プレビュー" class="img-fluid mb-2" style="display: none; max-height: 100px;">
            </div>
            {{-- 実際のファイル選択フィールド（非表示） --}}
            <input type="file" name="image" id="image" class="d-none" accept="image/*">

            <div class="text-right">
                <button type="submit" class="btn btn-primary">投稿</button>
            </div>
        </form>
    </div>
</div>

{{-- 画像プレビュー用 JavaScript --}}
<script>
document.getElementById('image').addEventListener('change', function (event) {
    const file = event.target.files[0];
    const preview = document.getElementById('preview');
    const fileNameDisplay = document.getElementById('file-name');

    if (file && file.type.startsWith('image/')) {
        // ファイル名表示
        fileNameDisplay.textContent = '選択されたファイル: ' + file.name;

        // プレビュー表示
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
        preview.src = '#';
        fileNameDisplay.textContent = '';
    }
});
</script>