@foreach ($users as $user)
    <div class="media mb-3">
        <a href="{{ route('user.show', $user->id) }}">
            <img class="mr-3 rounded-circle" src="{{ Gravatar::src($user->email, 50) }}" alt="{{ $user->name }}">
        </a>
        <div class="media-body">
            <h5 class="mt-0">
                <a href="{{ route('user.show', $user->id) }}" class="text-dark"
                style="text-decoration: none; transition: all 0.2s ease;"
                onmouseover="this.style.textDecoration='underline';"
                onmouseout="this.style.textDecoration='none';">
                    {{ $user->name }}
                </a>
            </h5>
            @include('follow.follow_button', ['user' => $user])
        </div>
    </div>
@endforeach