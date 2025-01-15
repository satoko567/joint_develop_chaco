{{--@extends('')--}}
{{--@section('content')--}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h2 class="mt-5">投稿を編集する</h2>
<form method="POST" action="{{route('post.update', $post->id)}}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <textarea id="content" class="form-control" name="content" rows="">{!! old('content', $post->content) !!}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">更新する</button>
</form>

{{--@endsection--}}