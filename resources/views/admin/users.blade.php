@extends('layouts.app')
@section('content')
<div class="center">
    <img class="w-50 mb-5 mx-auto d-block" src="{{ asset('images/admin_top.png') }}" alt="トップ画像">
</div>

<form method="GET" action="{{ route('admin.show.users') }}" class="mb-4 d-flex gap-2 flex-wrap align-items-end">
    <div>
        <input type="text" name="name" id="name" value="{{ request('name') }}" class="form-control" placeholder="名前を入力">
    </div>

    <div>
        <label for="is_admin" class="form-label ml-3">権限</label>
        <select name="is_admin" id="is_admin" class="form-select">
            <option value="">all</option>
            <option value="1" {{ request('is_admin') === '1' ? 'selected' : '' }}>admin</option>
            <option value="0" {{ request('is_admin') === '0' ? 'selected' : '' }}>general</option>
        </select>
    </div>

    <div>
        <button type="submit" class="btn btn-primary mx-1">検索</button>
        <a href="{{ route('admin.show.users') }}" class="btn btn-secondary">リセット</a>
    </div>
</form>

<ul class="list-group">
    @foreach($users as $user)
    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
        <div class="me-auto">
            <strong>{{ $user->name }}</strong>
            <span class="badge bg-{{ $user->is_admin ? 'danger' : 'secondary' }} ms-2 text-white">
                {{ $user->is_admin ? 'admin' : 'general' }}
            </span>
        </div>
        <div class="d-flex">
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('POST')
                <button type="submit" class="btn btn-outline-success btn-sm">Change</button>
            </form>
            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="mx-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
            </form>
        </div>
    </li>
    @endforeach
</ul>

<div class="m-auto" style="width: fit-content">
    {{ $users->appends(request()->query())->links() }}
</div>
@endsection
