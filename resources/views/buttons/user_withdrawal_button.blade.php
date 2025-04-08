{{-- rikoさんユーザ編集ページにこのファイルをincludeしてもらう --}}
@extends('layouts.app') {{-- rikoさんユーザ編集ページがマージされたら、削除する --}}
@section('content') {{-- rikoさんユーザ編集ページがマージされたら、削除する --}}
    @if (Auth::check()) {{-- rikoさんユーザ編集ページがマージされたら、削除する --}}
        @include('commons.delete_modal')

        <!-- 削除ボタン：data-url でURLを渡す -->
        <button class="btn btn-danger"
        data-toggle="modal"
        data-target="#deleteModal"
        data-title="本当に退会しますか？"
        data-url="{{ route('users.delete', $user->id) }}"
        data-btn_name="退会">
        退会
        </button>
    @endif {{-- rikoさんユーザ編集ページがマージされたら、削除する --}}
@endsection {{-- rikoさんユーザ編集ページがマージされたら、削除する --}}