<div class="p-3 rounded" style="background-color: #ffe6e6;">
    <h4 class="mb-3">🗨 最新リプライ</h4>
    @forelse($latestReplies as $reply)
        <div class="mb-2 border-bottom pb-2 w-100">
            <strong>{{ $reply->user->name }}</strong>
            <p class="mb-1">{{ Str::limit($reply->content, 50) }}</p>
            <small class="text-muted">{{ $reply->created_at->format('Y-m-d H:i') }}</small>
        </div>
    @empty
        <p class="text-muted">まだリプライはありません。</p>
    @endforelse
</div>
