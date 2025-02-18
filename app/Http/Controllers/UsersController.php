<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

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
    public function uploadIcon(Request $request)
    {
        $request->validate([
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // 現在ログイン中のユーザーを取得
        $user = User::findOrFail(Auth::id());
         // 既存のアイコンがあれば削除
        if ($user->icon) {
            Storage::disk('public')->delete('icons/'.$user->icon);
        }
        
        // アイコン画像が送信されているか確認
        if ($request->hasFile('icon')) {
            
            // 画像をストレージに保存（publicディスク）
            $path = $request->file('icon')->store('icons', 'public');
            
            // ユーザーのアイコンを更新
            $user->icon = basename($path);
            $user->save();
        }

        return redirect()->route('users.show', $user->id)
                         ->with('success', 'アイコンがアップロードされました');
    }
    public function timeline($id)
    {
        $user = User::findOrFail($id);

        $posts = $user->posts()->with('user')->get();
        $followings = $user->following()->withPivot('created_at')->get();

        $activities = $followings->merge($posts);

        // contentでソート（postかどうかを判定）
        $activities = $activities->sortByDesc(function ($activity) {
            return isset($activity->content) ? $activity->created_at : $activity->pivot->created_at;
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
