@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="w-75 mx-auto">
            <div class="mb-4 b-3">
                <h4 class="fw-bold border-bottom pb-2 mb-3">
                    <i class="fas fa-user-circle me-2 text-secondary"></i> {{ $post->user->name }} さんの投稿
                </h4>
                @if ($post->average_ratings)
                    <div class="mt-3 mb-3">
                        <h6 class="fw-bold mb-1">平均評価</h6>
                        <div class="d-flex align-items-center">
                            <span class="me-1" style="font-size: 1.4rem; color: #000;">
                                {{ $post->average_ratings['overall'] !== null ? number_format($post->average_ratings['overall'], 1) : '-' }}
                            </span>
                            <span style="color: gold; font-size: 1.4rem;">
                                {{ $post->average_ratings['overall'] !== null ? '★' : '' }}
                            </span>
                        </div>
                        <small class="text-muted">
                            接客：{{ display_star_rating($post->average_ratings['service']) }}／
                            料金：{{ display_star_rating($post->average_ratings['cost']) }}／
                            技術：{{ display_star_rating($post->average_ratings['quality']) }}
                        </small>
                    </div>
                @endif
                <div class="p-4 border rounded bg-light mb-4">
                    <h5 class="mb-3 text-break">
                        <i class="fas fa-tools me-2 text-secondary"></i>
                        <strong>{{ $post->shop_name }}</strong>
                    </h5>
                    <div class="mb-3">
                        <p class="mb-0 text-break text-muted">
                            <i class="fas fa-map-marker-alt me-2 text-secondary"></i>{{ $post->address }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <div class="fw-bold text-dark mb-1">投稿内容：</div>
                        <p class="mb-0 text-break">{{ $post->content }}</p>
                    </div>
                    @if ($post->tags->isNotEmpty())
                        <div class="mt-3">
                            @foreach ($post->tags as $tag)
                                <a href="{{ route('posts.index', ['keyword' => $tag->name]) }}"
                                style="font-size: 0.85rem; color: #6c757d; margin-right: 0.5em; text-decoration: none;">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                    <div class="text-end">
                        <small class="text-muted">投稿日：{{ $post->created_at }}</small>
                    </div>
                </div>
                @php
                    $defaultImage = config('constants.no_image_path');
                    $imageUrl = $post->image
                        ? asset('storage/' . $post->image)
                        : asset($defaultImage);
                @endphp
                <div class="text-center">
                    <img src="{{ $imageUrl }}" class="img-fluid rounded shadow-sm mb-3" style="max-height: 400px; object-fit: contain; background-color: #f8f9fa;" alt="投稿画像">
                </div>
            </div>
            @include('commons.error_messages')
            @if (Auth::check() && Auth::id() !== $post->user_id)
                @if ($hasReviewed)
                    <p class="text-muted">※あなたはこの投稿にすでにレビューしています</p>
                @endif
                <form action="{{ route('reviews.store', $post->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="comment">レビュー内容</label>
                        <textarea name="comment" id="comment" class="form-control" rows="3">{{ old('comment') }}</textarea>
                    </div>
                    {{-- 接客・対応 --}}
                    <div class="form-group mt-3">
                        <label>接客・対応の満足度（1〜5☆）※任意</label><br>
                        @for ($i = 1; $i <= 5; $i++)
                            <label class="me-2">
                                <input type="radio" name="rating_service" value="{{ $i }}" {{ old('rating_service') == $i ? 'checked' : '' }}>
                                {{ $i }}<span style="color: gold;">★</span>
                            </label>
                        @endfor
                    </div>
                    {{-- 料金の妥当性 --}}
                    <div class="form-group mt-2">
                        <label>料金の妥当性について（1〜5☆）※任意</label><br>
                        @for ($i = 1; $i <= 5; $i++)
                            <label class="me-2">
                                <input type="radio" name="rating_cost" value="{{ $i }}" {{ old('rating_cost') == $i ? 'checked' : '' }}>
                                {{ $i }}<span style="color: gold;">★</span>
                            </label>
                        @endfor
                    </div>
                    {{-- 技術・仕上がり --}}
                    <div class="form-group mt-2">
                        <label>修理の仕上がり精度（1〜5☆）※任意</label><br>
                        @for ($i = 1; $i <= 5; $i++)
                            <label class="me-2">
                                <input type="radio" name="rating_quality" value="{{ $i }}" {{ old('rating_quality') == $i ? 'checked' : '' }}>
                                {{ $i }}<span style="color: gold;">★</span>
                            </label>
                        @endfor
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">レビューする</button>
                </form>
            @elseif (Auth::check() && Auth::id() === $post->user_id)
                <p class="text-muted">※自分の投稿にはレビューできません。</p>
            @else
                <p class="text-muted">※レビューするにはログインが必要です。</p>
            @endif
            <hr>
            <h5>みんなのレビュー（{{ $countReviews }} 件）</h5>
            @if ($reviews->isEmpty())
                <p class="text-muted">まだレビューはありません。</p>
            @else
                @foreach ($reviews as $review)
                    <div
                        class="card mb-3 {{ $latestReview && $review->id === $latestReview->id ? 'border border-dark' : '' }}"
                        @if ($latestReview && $review->id === $latestReview->id)
                            style="background-color: #f8f9fa;"
                        @endif
                    >
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>
                                    {{ $review->user->name }}
                                    @if ($latestReview && $review->id === $latestReview->id)
                                        <span class="badge border border-dark text-dark ms-2">最新</span>
                                    @endif
                                </strong>
                                <small class="text-muted">{{ $review->created_at }}</small>
                            </div>
                            <p class="mt-2 mb-2">{{ $review->comment }}</p>
                            <ul class="list-unstyled ms-2">
                                <li>
                                    接客・対応の満足度　：
                                    @if ($review->rating_service !== null)
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span style="color: {{ $i <= $review->rating_service ? 'gold' : 'lightgray' }}">★</span>
                                        @endfor
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </li>
                                <li>
                                    料金の妥当性について：
                                    @if ($review->rating_cost !== null)
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span style="color: {{ $i <= $review->rating_cost ? 'gold' : 'lightgray' }}">★</span>
                                        @endfor
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </li>
                                <li>
                                    修理の仕上がり精度　：
                                    @if ($review->rating_quality !== null)
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span style="color: {{ $i <= $review->rating_quality ? 'gold' : 'lightgray' }}">★</span>
                                        @endfor
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </li>
                            </ul>
                            @if (Auth::check() && Auth::id() === $review->user_id)
                                <div class="text-end">
                                    <a href="{{ route('reviews.edit', ['post_id' => $post->id, 'review_id' => $review->id]) }}" class="btn btn-sm btn-outline-primary me-1">編集</a>
                                    <form action="{{ route('reviews.delete', ['review_id' => $review->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="m-auto" style="width: fit-content">
    {{ $reviews->links('pagination::bootstrap-4') }}
    </div>
@endsection