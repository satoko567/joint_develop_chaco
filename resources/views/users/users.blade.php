@foreach ($users as $user)
    <div class="media mb-3">
        <img class="mr-3 rounded-circle" src="{{ Gravatar::src($user->email, 50) }}" alt="{{ $user->name }}">
        <div class="media-body">
            <h5 class="mt-0">{{ $user->name }}</h5>

            {{-- フォローボタン --}}
            @if (Auth::check() && Auth::id() !== $user->id)
                @include('follow.follow_button', ['user' => $user])
            @endif
        </div>
    </div>
@endforeach