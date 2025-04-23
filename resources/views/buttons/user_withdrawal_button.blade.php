
{{-- 共通削除モーダル --}}
@include('commons.delete_modal')

<!-- 削除ボタン：data-url でURLを渡す -->
<button class="btn btn-danger"
    data-toggle="modal"
    data-target="#deleteModal"
    data-title="本当に退会しますか？"
    data-url="{{ route('users.delete', $user->id) }}"
    data-btn_name="退会">
    退会する
</button>

