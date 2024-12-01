@extends('layouts.app')
@section('content')
<h2>検索フォーム</h2>
    <form method="GET" action="{{ route('search.index') }}">
        @csrf    
        <input type="text" name="search" class="form-control input-lg" value="{{ old('search', $search ?? '') }}" placeholder="検索したいキーワードを入力">
            <span class="input-group-btn">
                <button class="btn btn-info btn-lg" type="submit">検索</button>
                    <i class="fas fa-search"></i>
            </span>
    </form>
        <div class="col-sm-12 mt-4">
                    <ul class="nav nav-tabs nav-justified mb-3">
                        <li class="nav-item"><a href="{{ route('search.index', ['search' => $search, 'tab' => 'posts']) }}" class="nav-link {{ $tab === 'posts' ? 'active' : '' }}">投稿</a></li>
                        <li class="nav-item"><a href="{{ route('search.index', ['search' => $search, 'tab' => 'users']) }}" class="nav-link {{ $tab === 'users' ? 'active' : '' }}">ユーザー</a></li>
                    </ul>
                    @if ($tab === 'posts' && $posts)
                        @if (!$posts->isEmpty())
                            @include('posts.posts', ['posts' => $posts])
                        @else
                            <p>該当する投稿はありません。</p>
                        @endif
                    @elseif ($tab === 'users' && $users)
                        @if (!$users->isEmpty())
                            @include('users.users', ['users' => $users])
                        @else
                            <p>該当するユーザーはありません。</p>
                        @endif
                    @endif
                </div>
@endsection