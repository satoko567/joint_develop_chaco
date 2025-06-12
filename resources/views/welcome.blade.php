@extends('layouts.app')
@section('content')
    <div class="center jumbotron bg-info">
        <div class="text-center text-white mt-2 pt-1">
            <h1><i class="fas fa-chalkboard-teacher pr-3 d-inline"></i>寺子屋＠プログラミング</h1>
        </div>
    </div>
    <h5 class="description text-center mb-3">"○○"について140字以内で会話しよう！</h5>
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
    @if (Auth::check())
        <div class="w-75 m-auto">@include('commons.error_messages')</div> 
        <div class="text-center mb-3">
            @include('posts.form')
        </div>
    @endif
    @include('posts.posts', ['posts' => $posts])
    </div>    
@endsection