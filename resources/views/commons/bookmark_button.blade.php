@auth
    @if (auth()->check() && auth()->user()->bookmarkedPosts->contains($post->id))
        <!-- ブックマーク済みの場合 -->
        <form action="{{ route('unbookmark.destroy', $post->id) }}" method="POST" class="d-inline ml-2" style="margin-bottom: 0;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-link p-0 text-decoration-none">
                <i class="fas fa-bookmark" style="color: #008000;"></i> <!-- ブックマーク済みアイコン -->
                <span style="color: #008000;">{{ $post->bookmarkedByUsers->count() }}</span>
            </button>
        </form>
    @else
        <!-- 未ブックマークの場合 -->
        <form action="{{ route('bookmark.store', $post->id) }}" method="POST" class="d-inline ml-2" style="margin-bottom: 0;">
            @csrf
            <button type="submit" class="btn btn-link p-0 text-decoration-none">
                <i class="far fa-bookmark text-muted"></i> <!-- ブックマークアイコン -->
                <span class="text-muted">{{ $post->bookmarkedByUsers->count() }}</span>
            </button>
        </form>
    @endif
@endauth
@guest
    <!-- ゲストユーザーにはアイコン非表示またはログインリンク -->
    <a href="{{ route('login') }}" class="btn btn-link p-0 text-decoration-none">
        <i class="far fa-bookmark text-muted ml-2"></i> <!-- ブックマークアイコン -->
        <span class="text-muted">{{ $post->bookmarkedByUsers->count() }}</span>
    </a>
@endguest
