@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('/css/welcome.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/search/search.css')}}">
@endsection
@section('content')
    @if (session('successMessage'))
        <div class="alert alert-success text-center w-30 mx-auto">
            {{ session('successMessage') }}
        </div>
    @elseif (session('alertMessage'))
        <div class="alert alert-danger text-center w-30 mx-auto">
            {{ session('alertMessage') }}
        </div>
    @endif
    <div class="center jumbotron">
        <div class="text-center text-white mt-2 pt-1">
            <h1 class="custom__heading"><img src="{{ asset('images/logo_white.png') }}" alt="Ramengram"></h1>
        </div>
    </div>
    <div class="content-f">
        <div class="custom-left">
            <h5 class="text-center mb-3">"ラーメン"について140字以内で会話しよう！</h5>
            <div class="w-75 m-auto">
            @include('commons.error_messages')
            </div>
            <div class="text-center mb-3">
            @if(Auth::check())
                <form method="POST" action="{{ route('post.store') }}" class="d-inline-block w-75" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="row-btn">
                            <div id="image-preview-container" class="mt-3">
                                <img id="image_preview" src="#" alt="選択した画像のプレビュー" class="img-fluid" style="display:none; max-width: 100%; height: auto;">
                                <video id="video_preview" controls class="img-fluid" style="display:none; max-width: 100%; height: auto;">
                                </video>
                            </div>
                            <textarea class="form-control" name="content" rows="4" style="margin-top: 10px;" placeholder="投稿についてコメントしよう！"></textarea>
                                <label for="image_file" class="custom-file-upload" style= "margin-top:10px">
                                    画像をアップロード
                                    <input type="file" id="image_file" name="image_file" style="display:none;">
                                </label>
                                <label for="video" class="custom-file-upload">
                                    動画をアップロード
                                    <input type="file" id="video" name="video" style="display:none;">
                                </label>
                                <input class="form-control mt-3" type="text" id="tags" name="tags" placeholder="タグを入力（例：#ラーメン #つけ麺）">
                                <p class="text-left">※複数のタグを入力する場合は、半角スペースを入れてください。</p>
                                <div class="text-left mt-3">
                                    <button type="submit" class="btn btn-primary">投稿する</button>
                                </div>
                        </div>
                    </div>
                </form>
            @endif
            </div>
            @include('posts.posts', ['posts' => $posts])
        </div>
        <aside class="custom-right">
            <div class="custom-search-input">
                <form class="input-group col-md-12" method="GET" action="{{ route('search') }}">
                    @csrf
                    <input type="text" name="keyword" class="form-control input-lg" value="{{ old('keyword', $keyword ?? '') }}" placeholder="検索" />
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </span>
                </form>
            </div>
            @include('favorite.top_favorite_posts', ['topPosts' => $topPosts])
        </aside>
    </div>
@endsection
@section('script')
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            let tagsInput = document.getElementById('tags');
            let tags = tagsInput.value.split(' ').map(tag => tag.trim().replace(/^#/, '')).filter(tag=> tag !== '');
            tagsInput.value = tags.join(',');
        });
    </script>
    <script>
        // テキスト内のURLを判定して青文字リンクに変換する関数
        function highlightUrls(text) {
            const urlPattern = /(https?:\/\/[^\s]+)/g;
            return text.replace(urlPattern, function(url) {
                return `<a href="${url}" class="highlighted-url" target="_blank">${url}</a>`;
            });
        }

        // コメント欄の入力を監視してURLを判定
        document.getElementById('content').addEventListener('input', function() {
            const commentText = this.value;
            const formattedText = highlightUrls(commentText);
            document.getElementById('content-preview').innerHTML = formattedText;
        });

        // 画像選択時のプレビュー表示
        document.getElementById('image_file').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imagePreview = document.getElementById('image_preview');
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block'; // 画像プレビューを表示
                    document.getElementById('video_preview').style.display = 'none'; // 動画プレビューを非表示
                };
                reader.readAsDataURL(file);
            }
        });

        // 動画選択時のプレビュー表示
        document.getElementById('video').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const videoPreview = document.getElementById('video_preview');
                const videoURL = URL.createObjectURL(file);
                videoPreview.src = videoURL;
                videoPreview.style.display = 'block'; // 動画プレビューを表示
                document.getElementById('image_preview').style.display = 'none'; // 画像プレビューを非表示
            }
        });
    </script>
@endsection
