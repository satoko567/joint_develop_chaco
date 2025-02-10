<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UsersController extends Controller
{
    public function edit(User $user)
    {
        if (Auth::id() !== $user->id) {
            return redirect()->route('home')->with('status', '権限がありません🙅');
        }

        return view('users.edit', compact('user'));
    }

    public function update(UserEditRequest $request)
    {
        $user = Auth::user();
        $user->nickname = $request->nickname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('status', '編集に成功しました✅');
    }

    public function destroy()
    {
        $user = Auth::user();
        Auth::logout();
        $user->delete();
        $user->posts()->delete(); 

        return redirect()->route('home')->with('status', 'ご利用ありがとうございました😢');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('id', 'desc')->paginate(10);
        return view('users.show', [
            'user' => $user,
            'posts' => $posts,
        ]);
        //$data += $this->userCounts($user);
    }

    public function timeline($id)
    {
        $user = User::findOrFail($id);

        //Postの取得、map(function(){...})を使用しデーター種類の定義をする
        $posts = $user->posts()->with('user')->get()->map(function ($post) {
            $post->activity_type = 'post';
            return $post;
        });

        //フォローしたユーザーの取得、map(function(){...})を使用しデーター種類の定義をする
        $followings = $user->following()->withPivot('created_at')->get()->map(function ($following) {
            $following->activity_type = 'following';
            return $following;
        });

        //データーのマージ
        $activities = $followings->merge($posts);

        //データー種類により、参照するcreated_atを定義
        $activities = $activities->sortByDesc(function ($activity) {
            return $activity->activity_type === 'post'
                ? $activity->created_at
                : $activity->pivot->created_at;
        });

        //$activitiesはcollectionデーターであり、 paginate() メソッドが存在しない為、手動で定義。
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;
        $total = $activities->count();

        $currentItems = $activities->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $paginatedActivities = new LengthAwarePaginator($currentItems, $total, $perPage, $currentPage, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);

        return view('users.show', [
            'user'       => $user,
            'activities' => $paginatedActivities,
        ]);
    }
}
