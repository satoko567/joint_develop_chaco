<!-- 右のサイドバー -->
<div class="col-3 pr-5">
    <div class="card shadow-sm mx-0 border-secondary" style="position: sticky; top: 0;">
        <div class="card-header bg-light text-dark text-left border-secondary" >
            <h5 class="m-0 p-0">Search</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('search.index') }}">
                <div class="form-group mb-3">
                    <input type="text" name="keyword" class="form-control border-secondary" placeholder="キーワードで検索" value="{{ request('keyword') }}">
                </div>
                <button type="submit" class="btn btn-secondary w-100">Search</button>
            </form>
        </div>
    </div>
</div>