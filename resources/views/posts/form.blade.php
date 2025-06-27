@include('components.flash_message')
<div class="card mt-4 shadow-sm mx-auto" style="max-width: 800px;">
    <div class="card-body">
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <textarea name="content" id="content" class="form-control" rows="3" placeholder="いまどうしてる？">{{ old('content') }}</textarea>
            </div>

            {{-- タグ一覧 --}}
            <div class="form-group mb-3 text-left">
                <label class="mb-2">タグを選択</label>
                <div class="mx-auto" style="max-width: 750px;">
                    <div class="d-flex flex-wrap" style="gap: 6px;">
                        @foreach ($tags as $tag)
                            <div class="px-1 py-0" style="white-space: nowrap;">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                    {{ (is_array(old('tags')) && in_array($tag->id, old('tags'))) ? 'checked' : '' }}>
                                <!-- タグ名をリンクにしてモーダルを表示 -->
                                <a href="#" data-toggle="modal" data-target="#deleteTagModal{{ $tag->id }}" class="ml-1" style="color: inherit;">
                                    {{ $tag->name }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- タグを追加リンク --}}
                <div class="form-group mt-2">
                    <a href="#" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#addTagModal">
                        ＋タグを追加
                    </a>
                </div>
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

        <!-- タグ追加モーダル -->
        <div class="modal fade" id="addTagModal" tabindex="-1" role="dialog" aria-labelledby="addTagModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" action="{{ route('tags.store') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addTagModalLabel">新しいタグを追加</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" name="name" class="form-control" placeholder="例: Laravel" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info">追加</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @foreach ($tags as $tag)
            <!-- 削除確認モーダル -->
            <div class="modal fade" id="deleteTagModal{{ $tag->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteTagModalLabel{{ $tag->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">タグ削除の確認</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            「<strong>{{ $tag->name }}</strong>」タグを削除してもよろしいですか？
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('tags.destroy', $tag->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">削除する</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
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