{{-- バリデーションエラーの表示 --}}
@include('commons.error_messages')

{{-- 投稿フォーム --}}
<div class="text-center mt-3 mb-3">
        <form method="POST" action="{{route('post.store')}}">
            @csrf
            <div class="form-group">
                <textarea type="content" class="form-control custom-textarea" name="content" rows="4"></textarea>
                <div class="text-left mt-3">
                    <button type="submit" class="btn btn-primary mt-2">投稿する</button>
                </div>
            </div>
        </form>
</div>
