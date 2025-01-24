@foreach ($users as $user)  <!-- ユーザー一覧が繰り返し表示されている前提 -->
    <div class="user-item">
        <!-- ユーザー名にリンクを付ける -->
        <h5>
            <a href="{{ route('users.show', $user->id) }}">
                {{ $user->name }}  <!-- ユーザー名 -->
            </a>
        </h5>
        <!-- 他のユーザー情報がここに来る -->
    </div>