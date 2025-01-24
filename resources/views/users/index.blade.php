<!-- users/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>ユーザー一覧</h2>

        <!-- ユーザーが1人もいない場合のメッセージ -->
        @if($users->isEmpty())
            <p>ユーザーがいません。</p>
        @else
            @foreach ($users as $user)
                <div class="user-item">
                    <!-- ユーザー名にリンクを付ける -->
                    <h5>
                        <a href="{{ route('users.show', $user->id) }}">
                            {{ $user->name }}  <!-- ユーザー名 -->
                        </a>
                    </h5>
                    <!-- 他のユーザー情報（例: メールアドレスなど） -->
                    <p>{{ $user->email }}</p>
                </div>
            @endforeach
        @endif

        <!-- ページネーション（ページ数がある場合） -->
        {{ $users->links() }}
    </div>
@endsection
