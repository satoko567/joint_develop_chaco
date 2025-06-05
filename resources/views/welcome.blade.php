@extends('layouts.app')
@section('content')
    <div class="center jumbotron bg-info">
        <div class="text-center text-white mt-2 pt-1">
            <h1><i class="fas fa-chalkboard-teacher pr-3 d-inline"></i>寺子屋＠プログラミング</h1>
        </div>
    </div>
    <form method="GET" action="{{ route('post.index') }}" class="mx-auto mt-4" style="width: 500px;">
     <div class="form-group ">
         <div class="input-group">
             <input type="text" name="keyword" class="form-control" placeholder="検索"  value="{{ old('keyword', $keyword) }}" autocomplete="on">
             <div class="input-group-append">
                 <button type="submit" class="btn" style="background-color: #17A2B8; color: white;">検索</button>
             </div>
         </div>
      </div>
    </form>
    <ul>
        @if (!empty($keyword) && $posts->isEmpty())
            <p class="mt-4 mb-3 text-center">「{{ $keyword }}」に一致する投稿はありませんでした。</p>
        @elseif ($posts->isNotEmpty())
            @foreach ($posts as $post)
                <!-- 投稿の表示 -->
            @endforeach
        @else
            <p>投稿がまだありません。</p>
        @endif
    </ul>
    {{ $posts->links() }}
    <h5 class="description text-center mb-3">"○○"について140字以内で会話しよう！</h5>
    @if (Auth::check())
        <div class="w-75 m-auto">@include('commons.error_messages')</div> 
        <div class="text-center mb-3">
            <form method="POST" action="{{ route('posts.store' )}}" class="d-inline-block w-75"> 
                @csrf          
                <div class="form-group">
                    <textarea class="form-control" name="content" rows="4">{{ old('content') }}</textarea>
                    <div class="text-left mt-3">
                        <button type="submit" class="btn btn-primary">投稿する</button>
                    </div>
                </div>
            </form>
        </div>
    @endif
    @include('posts.posts', ['posts' => $posts])
    </div>    
@endsection