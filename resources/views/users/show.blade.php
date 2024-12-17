@extends('layouts.app')
@section('content')
@include('commons.flash_message')
@yield('scripts')
<div class="container">
<div class="row">
    <aside class="col-sm-4 mb-5">
        <div class="userCard-container">
            <div class="userCard" onclick="toggleCard(this)">
                <div class="userCard-front">
                    <div class="userCard-header">
                        <h3 class="userCard-title" style="display: inline-block; margin-right: 200px;">
                            {{ $user->name }}
                        </h3>
                        @if (Auth::id() === $user->id)
                            <div class="mt-3" style="display: inline-block;">
                                <a href="{{ route('user.edit', $user->id) }}" style="text-decoration: none;">
                                    <i class="fas fa-pencil-alt fa-2x"></i>
                                </a>
                            </div>
                        @endif
                        {{-- Follow Button --}}
                        @include('commons.follow_button',['user'=> $user])
                    </div>
                    <div class="userCard-body">
                        @if($user->avatar)
                            <img class="rounded-circle img-fluid" src="{{ Storage::url($user->avatar) }}" alt="現在のプロフィール画像">
                        @else
                            <img class="rounded-circle img-fluid" src="{{ Gravatar::src($user->email, 400) }}" alt="ユーザのアバター画像">
                        @endif  
                    </div>
                </div>
                <div class="userCard-back">
                    <div class="userCard-header">
                        <h4>{{ $user->name }}</h4>
                    </div>
                    <div class="userCard-body">
                        @if($user->profile)
                            <p>{{ $user->profile }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <div class="col-sm-8">
        <ul class="nav nav-tabs nav-justified mb-3">
            <li class="nav-item"><a href="{{ route('user.show', $user->id) }}" class="nav-link {{ Request::is('users/' . $user->id) ? 'active' : '' }}">タイムライン</a></li>
            <li class="nav-item"><a href="{{ route('users.followings', $user->id) }}" class="nav-link {{ Request::is('users/' . $user->id . '/followings') ? 'active' : '' }}">フォロー中 <span class="badge badge-primary">{{ $user->following()->count() }}</span></a></li>
            <li class="nav-item"><a href="{{ route('users.followers', $user->id) }}" class="nav-link {{ Request::is('users/' . $user->id . '/followers') ? 'active' : '' }}">フォロワー <span class="badge badge-primary">{{ $user->followers()->count() }}</span></a></li>
            @if (Auth::id() === $user->id)
                <li class="nav-item"><a href="{{ route('bookmarkedPosts.index', $user->id) }}" class="nav-link {{ Request::is('users/' . $user->id . '/bookmarkedPosts') ? 'active' : '' }}">ブックマーク</a></li>
            @endif
        </ul>

        @if (isset($posts))
            {{-- 投稿 --}}
            @include('posts.posts',['posts'=> $posts])
        @elseif (isset($users))
            @include('commons.follow_list', ['users'=> $users, 'message'=> $message])
        @elseif (isset($bookmarkedPosts))
            @include('commons.bookmarkedPosts_index', ['bookmarkedPosts' => $bookmarkedPosts])
        @endif
    </div>
</div>
@endsection
@push('styles')
    <style>
        .userCard-container {
            perspective: 1000px;
        }

        .userCard {
            background-color: #f2f2f2;
            width: 100%;
            height: 500px;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.6s ease-in-out;
            cursor: pointer;
        }

        .userCard-front, .userCard-back {
            background-color: #f2f2f2;
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            overflow: hidden;
        }

        .userCard-front {
            color: #2a0750;
            z-index: 2;
        }

        .userCard-back {
            color: #2a0750;
            transform: rotateY(180deg);
            z-index: 1;
        }

        .userCard.is-flipped {
            transform: rotateY(180deg);
        }
    </style>
@endpush
@push('scripts')
<script>
        function toggleCard(userCard) {
            userCard.classList.toggle('is-flipped'); // クラスを切り替える
        }
</script>
@endpush

