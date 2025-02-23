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
        $user->allComments()->delete();

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

        $posts = $user->posts()->with('user')->get();
        $followings = $user->following()->withPivot('created_at')->get();
        $comments = $user->allComments()->with('user', 'post', 'replies.user')->get();	

        $activities = $followings->merge($comments)->merge($posts);	

        // contentでソート（postかどうかを判定）
        $activities = $activities->sortByDesc(function ($activity) {
            return isset($activity->content) ? $activity->created_at : $activity->pivot->created_at;
        });

        //$activitiesはcollectionデーターであり、 paginate() メソッドが存在しない為、手動で定義。
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
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
