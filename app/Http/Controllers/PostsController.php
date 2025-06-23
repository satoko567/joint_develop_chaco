<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Review;
use App\Tag;
use App\Http\Requests\PostRequest;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index(SearchRequest $request)
    {
        $keyword = $request->input('keyword');
        $tag = null;

        $posts = $this->basePostQuery()
            ->when(Str::startsWith($keyword, '#'), function ($query) use ($keyword, &$tag) {
                $tagName = ltrim($keyword, '#');
                $tag = Tag::where('name', $tagName)->first();

                if ($tag) {
                    return $query->whereHas('tags', function ($q) use ($tag) {
                        $q->where('tags.id', $tag->id);
                    });
                } else {
                    return $query->whereRaw('0 = 1');
                }
            }, function ($query) use ($keyword) {
                return $query->when($keyword, function ($q, $kw) {
                    return $q->where('content', 'like', "%{$kw}%");
                });
            })
            ->paginate(9);
        $data = [
            'keyword' => $keyword,
            'tag' => $tag,
            'posts' => $posts,
        ];
        return view('welcome', $data);
    }

    public function indexByTagName($name)
    {
        $tag = Tag::where('name', $name)->first();
        if ($tag) {
            $posts = $this->basePostQuery()
                ->whereHas('tags', function ($query) use ($tag) {
                    $query->where('tags.id', $tag->id);
                })
                ->paginate(9);
        } else {
            $posts = new LengthAwarePaginator([], 0, 9);
        }
        $data = [
            'tag' => $tag,
            'posts' => $posts,
            'keyword' => null,
        ];
        return view('welcome', $data);
    }

    public function create()
    {
        $keyword = '';
        $posts = $this->basePostQuery()->paginate(9);

        return view('posts.create', [
            'posts' => $posts,
            'keyword' => $keyword,
        ]);
    }

    public function store(PostRequest $request)
    {
        $post = new Post;
        $post->shop_name = $request->shop_name;
        $post->address = $request->address;
        $post->content = $request->content;
        $post->user_id = $request->user()->id;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('post_images', 'public');
            $post->image = $path;
        }
        $post->save();
        $rawTags = $request->input('tags');
        $tagNames = Tag::parseTagNames($rawTags);
        if (!empty($tagNames)) {
            Tag::syncToPost($post, $tagNames);
        }
        return back()->with('flash_message', '投稿しました。ありがとう！');
    }

    public function show($id)
    {
        $post = Post::with(['user', 'tags'])->findOrFail($id);
        $reviews = $post->reviews()
            ->with('user')
            ->orderBy('id', 'desc')
            ->paginate(10);
        $latestReview = Review::latestReview($post);
        $hasReviewed = false;
        if (Auth::check() && Auth::id() !== $post->user_id) {
            $hasReviewed = Review::hasReviewed(Auth::user(), $post);
        }
        $data = [
            'post' => $post,
            'reviews' => $reviews,
            'latestReview' => $latestReview,
            'hasReviewed' => $hasReviewed,
        ];
        $data += Review::reviewCounts($post);
        return view('posts.show', $data);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if (\Auth::id() === $post->user_id) {
            $post->deleteImage();
            $post->deleteReviews();
            $post->detachTags();
            $post->delete();
        }
        return redirect()->back()->with('flash_message', '投稿を削除しました');
    }      

    //editメソッドを作成。動画編集のあたり
    public function edit($id) //編集ボタンを押した投稿データの、idを取得
    { 
        $post = Post::findOrFail($id); //選択した投稿に該当する、投稿データを取得。
        if (\Auth::id() === $post->user_id) { //自分の投稿以外は編集できないようにする。そのために、ログインユーザのidと、投稿データのidが一致しない場合はエラーを出す。
            $data = [
                'post' => $post,
            ];
            return view('posts.edit', $data); //posts.editビューを表示
        } 
        abort(404); //404エラーを返す。
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id); //idに該当する投稿データを取得。見つからなければ404エラーを返す
        $post->shop_name = $request->shop_name;
        $post->address = $request->address;
        $post->content = $request->input('content'); //投稿内容をpostテーブルのcontentカラムに代入
        if ($request->hasFile('image')) {
            $post->deleteImage();
            $path = $request->file('image')->store('post_images', 'public');
            $post->image = $path;
        }
        $post->save(); //postテーブルに保存
        $rawTags = $request->input('tags');
        $tagNames = Tag::parseTagNames($rawTags);
        if (!empty($tagNames)) {
            Tag::syncToPost($post, $tagNames);
        } else {
            $post->detachTags();
        }
        return redirect()->route('posts.show', $post->id)
            ->with('flash_message', '投稿を更新しました');
    }

    private function basePostQuery()
    {
        return Post::with([
                'user',
                'tags',
                'reviews' => function ($query) {
                    $query->whereNull('deleted_at');
                }
            ])
            ->withCount(['reviews' => function ($query) {
                $query->whereNull('deleted_at');
            }])
            ->orderBy('id', 'desc');
    }
}