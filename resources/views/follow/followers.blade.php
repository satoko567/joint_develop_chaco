@extends('layouts.app')

@section('content')

<div class="container" style="direction: rtl;">

    <h2 class="mb-5 text-center">
        Followers
        <span class="badge badge-pill badge bg-warning">{{ $totalCount['totalFollowers'] }}</span>
    </h2>

    <div class="row justify-content-center" style="row-gap: 20px; margin-bottom: 20px;">

        @foreach($followers as $index => $user)
        <div class="col-md-2 text-center d-flex flex-column align-items-center">

            <img src="{{ Gravatar::src($user->email, 55) }}" alt="ユーザのアバター画像" class="rounded-circle mb-2">

            <p class="mb-0">
                <a href="">{{ $user->nickname }}</a>
            </p>

            <p class="mb-0" style="color: white;">
                <span class="badge badge-pill badge bg-info">
                    Post数 {{ $user->posts()->count() }}
                </span>
            </p>

            @if (!Auth::user()->following->contains($user->id))
            <form method="POST" action="{{ route('follow', $user) }}" class="mt-2">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm">Follow Back</button>
            </form>
            @else
            <form method="POST" action="{{ route('unfollow', $user) }}" class="mt-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Unfollow</button>
            </form>
            @endif
        </div>

        @if (($index + 1) % 5 == 0)
    </div>
    <div class="row justify-content-center" style="row-gap: 20px; margin-bottom: 20px;">
        @endif
        @endforeach

    </div>
</div>

@endsection