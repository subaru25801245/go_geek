<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  // 認証されたユーザーのみアクセス可能
    }

    // お気に入り追加
    public function store(Post $post)
    {
        Auth::user()->favorite_posts()->attach($post->id);
        return redirect()->back()->with('message', 'お気に入りに追加しました。');
    }

    // お気に入り削除
    public function destroy(Post $post)
    {
        Auth::user()->favorite_posts()->detach($post->id);
        return redirect()->back()->with('message', 'お気に入りから削除しました。');
    }

    // お気に入り一覧表示
    public function index()
    {
        $favorites = Auth::user()->favorite_posts()->paginate(5);

        foreach ($favorites as $favorite) {
            $favorite->body = $this->linkifyHashtags($favorite->body);
        }
        return view('post.favorites', compact('favorites'));
    }

    protected function linkifyHashtags($text)
    {
        $pattern = '/#([\w\x{3040}-\x{309F}\x{30A0}-\x{30FF}\x{FF00}-\x{FFEF}\x{4E00}-\x{9FAF}]+)/u';
        return preg_replace($pattern, '<a href="/post/hashtags/$1" class="hashtag">#$1</a>', $text);
    }
}
