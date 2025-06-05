@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="w-75 mx-auto">
            <div class="mb-4 b-3">
                <h4>{{ $post->user->name }} さんの投稿</h4>
                <div class="alert alert-info">
                    <strong>投稿内容：<br>
                    {{ $post->content }}<br>
                    </strong>
                    <small class="text-muted">{{ $post->created_at }}</small>
                </div>
                @if ($averageRatings)
                    <div class="mb-2">
                        <h5 class="mb-1">
                            平均評価：
                            <span style="font-size: 1.5rem; color: #000;">
                                {{ $averageRatings['overall'] !== null ? number_format($averageRatings['overall'], 1) : '-' }}
                            </span>
                            <span style="color: gold; font-size: 1.5rem;">
                                {{ $averageRatings['overall'] !== null ? '★' : '' }}
                            </span>
                        </h5>
                        <small class="text-muted">
                            接客：{{ $averageRatings['service'] !== null ? number_format($averageRatings['service'], 1) . '★' : '-' }}　
                            料金：{{ $averageRatings['cost'] !== null ? number_format($averageRatings['cost'], 1) . '★' : '-' }}　
                            技術：{{ $averageRatings['quality'] !== null ? number_format($averageRatings['quality'], 1) . '★' : '-' }}
                        </small>
                    </div>
                @endif
                @php
                    $defaultImage = config('constants.no_image_path');
                    $imageUrl = $post->image
                        ? asset('storage/' . $post->image)
                        : asset($defaultImage);
                @endphp
                <img src="{{ $imageUrl }}"
                    class="img-fluid rounded mb-3 d-block mx-auto"
                    style="max-height: 400px; object-fit: contain; background-color: #f8f9fa;"
                    alt="投稿画像">
            </div>
            @include('commons.error_messages')
            @if (Auth::check() && Auth::id() !== $post->user_id)
                @if ($hasReplied)
                    <p class="text-muted">※あなたはこの投稿にすでにリプライしています</p>
                @endif
                <form action="{{ route('replies.store', $post->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="reply_body">リプライ内容</label>
                        <textarea name="reply_body" id="reply_body" class="form-control" rows="3">{{ old('reply_body') }}</textarea>
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
                    <button type="submit" class="btn btn-primary mt-2">リプライする</button>
                </form>
            @elseif (Auth::check() && Auth::id() === $post->user_id)
                <p class="text-muted">※自分の投稿にはリプライできません。</p>
            @else
                <p class="text-muted">※リプライするにはログインが必要です。</p>
            @endif
            <hr>
            <h5>リプライ一覧（{{ $countReplies }} 件）</h5>
            @if ($replies->isEmpty())
                <p class="text-muted">まだリプライはありません。</p>
            @else
                @foreach ($replies as $reply)
                    <div
                        class="card mb-3 {{ $latestReply && $reply->id === $latestReply->id ? 'border border-info' : '' }}"
                        @if ($latestReply && $reply->id === $latestReply->id)
                            style="background-color: #f0fafd;"
                        @endif
                    >
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>
                                    {{ $reply->user->name }}
                                    @if ($latestReply && $reply->id === $latestReply->id)
                                        <span class="badge border border-info text-info ms-2">最新</span>
                                    @endif
                                </strong>
                                <small class="text-muted">{{ $reply->created_at }}</small>
                            </div>
                            <p class="mt-2 mb-2">{{ $reply->content }}</p>
                            <ul class="list-unstyled ms-2">
                            @if ($reply->rating_service)
                                <li>
                                    接客・対応の満足度　：
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span style="color: {{ $i <= $reply->rating_service ? 'gold' : 'lightgray' }}">★</span>
                                    @endfor
                                </li>
                            @endif
                            @if ($reply->rating_cost)
                                <li>
                                    料金の妥当性について：
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span style="color: {{ $i <= $reply->rating_cost ? 'gold' : 'lightgray' }}">★</span>
                                    @endfor
                                </li>
                            @endif
                            @if ($reply->rating_quality)
                                <li>
                                    修理の仕上がり精度　：
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span style="color: {{ $i <= $reply->rating_quality ? 'gold' : 'lightgray' }}">★</span>
                                    @endfor
                                </li>
                            @endif
                        </ul>
                            @if (Auth::check() && Auth::id() === $reply->user_id)
                                <div class="text-end">
                                    <a href="{{ route('replies.edit', ['post_id' => $post->id, 'reply_id' => $reply->id]) }}" class="btn btn-sm btn-outline-primary me-1">編集</a>
                                    <form action="{{ route('replies.delete', ['reply_id' => $reply->id]) }}" method="POST" class="d-inline">
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
    {{ $replies->links('pagination::bootstrap-4') }}
    </div>
@endsection