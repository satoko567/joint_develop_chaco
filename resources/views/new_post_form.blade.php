<div class="text-center">
    <h1><i class="fa-solid fa-face-grin-wide"></i>Topic Post</h1>
</div>
<div class="text-center mt-3">
    <p class="text-left d-inline-block">"〇〇"について140文字以内で会話しよう！</p>
</div>
<div class="row mt-5 mb-5">
    <div class="col-sm-6 offset-sm-3">
        <form method="POST" action="{{route('post.store')}}">
            @csrf
            <div class="form-group">
                <input id="content" type="content" class="form-control" name="content" value="{{old('text')}}">
            </div>
            <button type="submit" class="btn btn-primary mt-2">投稿する</button>
        </form>
    </div>
</div>