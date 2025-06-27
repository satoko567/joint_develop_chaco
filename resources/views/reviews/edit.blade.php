@extends('layouts.app')
@section('title', 'レビュー編集 | クルマの名医ナビ')
@section('meta_description', '既存のレビュー内容を編集できます。接客・料金・技術の評価を見直し、最新の体験談を投稿しましょう。')
@section('content')
    <div class="container">
        <div class="mx-auto" style="max-width: 700px; width: 100%;">
            <div class="mb-4 mb-3">
                @include('commons.error_messages')
                <h4 class="mt-4 mb-3">レビュー内容を編集する</h4>
                <form action="{{ route('reviews.update', [$post->id, $review->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <textarea name="comment" id="comment" class="form-control" rows="3">{{ old('comment', $review->comment) }}</textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label>接客・対応の満足度（1〜5☆）※任意</label><br>
                        <label class="me-2">
                            <input type="radio" name="rating_service" value="" 
                                {{ old('rating_service', $review->rating_service) === null ? 'checked' : '' }}>
                            未選択
                        </label>
                        @for ($i = 1; $i <= 5; $i++)
                            <label class="me-2">
                                <input type="radio" name="rating_service" value="{{ $i }}" 
                                    {{ old('rating_service', $review->rating_service) == $i ? 'checked' : '' }}>
                                {{ $i }}<span style="color: gold;">★</span>
                            </label>
                        @endfor
                    </div>
                    <div class="form-group mt-3">
                        <label>料金の妥当性について（1〜5☆）※任意</label><br>
                        <label class="me-2">
                            <input type="radio" name="rating_cost" value="" 
                                {{ old('rating_cost', $review->rating_cost) === null ? 'checked' : '' }}>
                            未選択
                        </label>
                        @for ($i = 1; $i <= 5; $i++)
                            <label class="me-2">
                                <input type="radio" name="rating_cost" value="{{ $i }}" 
                                    {{ old('rating_cost', $review->rating_cost) == $i ? 'checked' : '' }}>
                                {{ $i }}<span style="color: gold;">★</span>
                            </label>
                        @endfor
                    </div>
                    <div class="form-group mt-3">
                        <label>修理の仕上がり精度（1〜5☆）※任意</label><br>
                        <label class="me-2">
                            <input type="radio" name="rating_quality" value="" 
                                {{ old('rating_quality', $review->rating_quality) === null ? 'checked' : '' }}>
                            未選択
                        </label>
                        @for ($i = 1; $i <= 5; $i++)
                            <label class="me-2">
                                <input type="radio" name="rating_quality" value="{{ $i }}" 
                                    {{ old('rating_quality', $review->rating_quality) == $i ? 'checked' : '' }}>
                                {{ $i }}<span style="color: gold;">★</span>
                            </label>
                        @endfor
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">更新する</button>
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-secondary mt-2">キャンセル</a>
                </form>
            </div>
        </div>
    </div>
@endsection