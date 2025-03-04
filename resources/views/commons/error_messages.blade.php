@if (count($errors) > 0)
    <ul class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
        <li class="ml-4">投稿は、必ず指定してください。</li>
        @endforeach
    </ul>
@endif