{{-- バリデーションエラーの表示 --}}
@include('commons.error_messages')

{{-- 投稿フォーム --}}
<div class="text-center mt-3 mb-3">
    <form method="POST" action="{{route('post.store')}}">
        @csrf
        <div class="form-group">
            <textarea type="content" class="form-control custom-textarea" name="content" rows="4"></textarea>
        </div>
        
        <!-- タグ入力フィールド -->
        <label for="tag-input"><i class="fa-solid fa-circle-down" style="color: hsl(187, 72%, 65%);"></i>タグをつけてね！（Enterまたはカンマで追加）</label>
        <input type="text" id="tag-input" class="form-control mb-2" placeholder="Laravel, PHP など">
        <div id="tag-container" class="mb-3"></div>
        <input type="hidden" name="tags" id="hidden-tags">
        
        <script>
            const tagInput = document.getElementById('tag-input');
            const tagContainer = document.getElementById('tag-container');
            const hiddenTagsInput = document.getElementById('hidden-tags');
            let tags = [];

            tagInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ',') {
                    e.preventDefault();
                    const value = tagInput.value.trim().replace(/^#|＃/, '');
                    if (value && !tags.includes(value)) {
                        tags.push(value);
                        renderTags();
                        tagInput.value = '';
                    }
                }
            });

            function renderTags() {
                tagContainer.innerHTML = '';
                tags.forEach((tag, index) => {
                    const badge = document.createElement('span');
                    badge.className = 'badge badge-primary mr-1';
                    badge.innerHTML = `#${tag} <span style="cursor:pointer" onclick="removeTag(${index})">&times;</span>`;
                    tagContainer.appendChild(badge);
                });
                hiddenTagsInput.value = tags.join(',');
            }

            function removeTag(index) {
                tags.splice(index, 1);
                renderTags();
            }
        </script>

        <div class="text-left mt-3">
            <button type="submit" class="btn btn-primary mt-2">投稿する</button>
        </div>
    </form>
</div>
