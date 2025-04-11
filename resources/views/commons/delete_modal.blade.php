<!-- 共通削除モーダル -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">確認</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p id="modal-message">本当に削除しますか？</p>
            </div>

            <div class="modal-footer">
                <form method="POST" id="deleteForm" action=""> {{--初期状態では空。ボタンからURLを取得して、actionにセットする。--}}
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="btn_name" class="btn btn-danger">削除</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            </div>

        </div>
    </div>
</div>