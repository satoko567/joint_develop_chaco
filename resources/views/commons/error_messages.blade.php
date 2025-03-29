{{-- エラーメッセージはこのファイルに書く。layouts.blade.phpで呼び出している。 --}}
@if (count($errors) > 0)
    <ul class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            <li class="ml-4">{{ $error }}</li>
        @endforeach
    </ul>
@endif