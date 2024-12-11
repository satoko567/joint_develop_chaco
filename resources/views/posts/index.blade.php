<form method="GET" action="{{ route('post.index') }}">
    @csrf    
    <input type="text" name="search" class="form-control input-lg" value="{{ old('search', $search) }}" placeholder="検索したいキーワードを入力">
        <span class="input-group-btn">
            <button class="btn btn-info btn-lg btn-sm mt-2" type="submit">検索</button>
                <i class="fas fa-search"></i>
        </span>
</form>