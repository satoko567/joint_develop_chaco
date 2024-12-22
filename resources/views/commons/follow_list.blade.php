@if($users->isEmpty())
    <p>{{ $message }}</p>
@else
<ul class="list-unstyled">
    @foreach ($users as $user)
        <li class="mb-3 text-center">
            <div class="row align-items-center w-75 mx-auto">
                <div class="col-8 d-flex align-items-center">
                    @if($user->avatar)
                        <img class="mr-2 rounded-circle" src="{{ Storage::url($user->avatar) }}" alt="プロフィール画像" style="width: 55px; height: 55px;">
                    @else
                        <img class="mr-2 rounded-circle" src="{{ Gravatar::src($user->email, 55) }}" alt="アバター画像">
                    @endif
                    <p class="mb-0">
                        <a href="{{ route('user.show', $user->id) }}">{{ $user->name }}</a>
                    </p>
                </div>
                <div class="col-4 text-right">
                    {{-- Follow Button --}}
                    @include('commons.follow_button',['user'=> $user])
                </div>
            </div>
        </li>
    @endforeach
</ul>
    <div class="m-auto" style="width: fit-content">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
@endif