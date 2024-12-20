<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // 検索機能
        $keyword = $request->input('keyword');

        $posts = Post::withCount('comments')->orderBy('id', 'desc');
        $users = User::with(['posts' => function ($query) {
            $query->withCount('comments');
        }])->orderBy('id', 'desc');

        if ($keyword !== null) {
            $posts->where('content', 'like', '%' . $keyword . '%');
            $users->where('name', 'like', '%' . $keyword . '%');
        }

        $posts = $posts->paginate(10)->appends(['keyword' => $keyword]);
        $users = $users->paginate(10)->appends(['keyword' => $keyword]);

        // おすすめユーザーの取得
        $similarUsers = collect();
        $hasSimilarUsers = false;
        if (Auth::check()) {
            $similarUsers = $this->getUsersWithSimilarAges(Auth::id());
            $hasSimilarUsers = $similarUsers->isNotEmpty();
        } else {
            $hasSimilarUsers = false;
        }
        return view('welcome', [
            'posts' => $posts,
            'users' => $users,
            'keyword' => $keyword,
            'similarUsers' => $similarUsers,
            'hasSimilarUsers' => $hasSimilarUsers,
        ]);
    }

    private function getUsersWithSimilarAges($id)
    {
        $user = User::find($id);
        if (!$user || !$user->date_of_birth) {
            return collect();
        }
        $followingIds = $user->following()->pluck('followed_id')->toArray();

        return User::where('id', '!=', $id)
            ->WithSimilarAges($user->date_of_birth, 5, $followingIds)
            ->take(5)
            ->get();
    }
}