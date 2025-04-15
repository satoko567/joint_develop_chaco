@extends('layouts.app')

@section('content')
    <h2 class="text-center mb-4">👍 いいねランキング</h2>

    @php
        $rank = 0;
        $prevLikes = null;
        $displayRank = 0;
    @endphp

    @push('styles')
        <style>
            .rank-size-1 {
                font-size: 1.5rem;
                /* 1位：大きく */
            }

            .rank-size-2 {
                font-size: 1.25rem;
                /* 2位 */
            }

            .rank-size-3 {
                font-size: 1.1rem;
                /* 3位 */
            }

            .rank-size-default {
                font-size: 1rem;
                /* その他 */
            }

            .text-orange {
                color: #cd7f32 !important;
                /* 銅メダル色 */
            }

            .bg-gold {
                background-color: #ffd700;
                color: #fff;
            }

            .bg-silver {
                background-color: #c0c0c0;
                color: #fff;
            }

            .bg-bronze {
                background-color: #cd7f32;
                color: #fff;
            }

            .bg-muted {
                background-color: #f8f9fa;
                color: #6c757d;
            }
        </style>
    @endpush

    <ul class="list-unstyled">
        @foreach ($rankingPosts as $post)
            <li class="mb-3 text-center">
                @php
                    $currentLikes = $post->likes->count();
                    $rank++;

                    // いいね数が前と違えば表示順位を更新
                    if ($currentLikes !== $prevLikes) {
                        $displayRank = $rank;
                        $prevLikes = $currentLikes;
                    }

                    // ランクに応じた色・文字サイズのクラスを設定
                    if ($displayRank === 1) {
                        $rankClass = 'text-warning font-weight-bold rank-size-1';
                        $bgClass = 'bg-gold';
                    } elseif ($displayRank === 2) {
                        $rankClass = 'text-secondary font-weight-bold rank-size-2';
                        $bgClass = 'bg-silver';
                    } elseif ($displayRank === 3) {
                        $rankClass = 'text-orange font-weight-bold rank-size-3';
                        $bgClass = 'bg-bronze';
                    } else {
                        $rankClass = 'text-muted rank-size-default';
                        $bgClass = 'bg-muted';
                    }
                @endphp

                <div class="{{ $rankClass }}">🏆 {{ $displayRank }}位（獲得👍 {{ $currentLikes }}）</div>

                {{-- 以下、投稿の表示 --}}
                <div class="{{ $bgClass }} p-3 rounded mb-3">
                    <div>{{ $post->name }}</div>
                    <div class="text-left d-inline-block w-75 mb-2">
                        <img class="mr-2 rounded-circle" src="{{ Gravatar::src($post->user->email, 55) }}" alt="ユーザのアバター画像">
                        <a href="{{ route('user.show', ['id' => $post->user->id]) }}"
                            style="text-decoration: none; color: blue;">
                            {{ $post->user->name }}
                        </a>
                    </div>

                    <div class="text-left d-inline-block w-75">
                        <p class="mb-2">{{ $post->content }}</p>
                        @if ($post->image_path)
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="投稿画像"
                                class="img-thumbnail clickable-image" style="width: 200px; cursor: pointer;"
                                data-image="{{ asset('storage/' . $post->image_path) }}">
                        @endif
                        <p class="text-muted">{{ $post->created_at }}</p>
                        {{-- ここにいいねボタンを追加 --}}
                        <div class="d-inline-block">
                            {{-- 💬リプライリンク ← 追加する！ --}}
                            <a href="{{ route('replies.index', $post->id) }}" class="btn btn-light">
                                💬 {{ $post->replies->count() }}
                            </a>
                            <form method="POST" action="{{ route('posts.like', $post->id) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-light"
                                    @if (Auth::id() === $post->user_id) disabled @endif>
                                    👍 {{ ($post->likes ?? collect([]))->count() }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @include('posts.post_actions')
            </li>
        @endforeach
    </ul>
@endsection
