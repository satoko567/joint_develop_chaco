@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>投稿検索</title>
</head>
<body>
    <form method="GET" action="{{ route('search.index') }}">
        <input type="text" name="search" placeholder="投稿検索...">
        <button type="submit">検索</button>
    </form>
</body>
</html>
@include('posts.posts', ['posts' => $posts])
@endsection