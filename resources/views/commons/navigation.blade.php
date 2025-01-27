        <!-- ナビゲーションタブ -->
        <ul class="nav nav-tabs nav-justified mb-3">
            <li class="nav-item">
                <a href="{{ route('users.show', $user->id) }}" class="nav-link {{ Request::is('users/'.$user->id) ? 'active' : '' }}">タイムライン</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('users.following', $user->id) }}" class="nav-link {{ Request::is('user/'.$user->id.'/following') ? 'active' : '' }}">
                    フォロー中
                    <span class="badge bg-warning ms-2" style="color: black;">
                        {{ totalCount($user)['totalFollowing'] }}
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('users.followers', $user->id) }}" class="nav-link {{ Request::is('user/'.$user->id.'/followers') ? 'active' : '' }}">
                    フォロワー
                    <span class="badge badge-pill badge bg-warning" style="color: black;">
                        {{ totalCount($user)['totalFollowers'] }}
                    </span>
                </a>
            </li>
        </ul>