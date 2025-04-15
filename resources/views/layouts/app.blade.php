<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Topic Posts</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> {{-- 様々なファイルの表示を、追加訂正するためのCSS --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    </head>
    <body>
        @include('commons.header')
        <div class="container">
            @yield('content')
        </div>
        @include('commons.footer')
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>

    {{-- 削除モーダル用javascript --}}
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget); //←モーダルを開くボタン
            const message = button.data('title'); //← data-titleの値を取得
            const url = button.data('url'); //← data-urlの値を取得
            const btn_name = button.data('btn_name'); //← data-btn_nameの値を取得
            const modal = $(this);
            modal.find('#modal-message').text(message); //←モーダルのメッセージを変更
            modal.find('#deleteForm').attr('action', url); //←モーダルformのactionを変更
            modal.find('#btn_name').text(btn_name); //←モーダルのボタン名を変更
        });
    </script>
</html>