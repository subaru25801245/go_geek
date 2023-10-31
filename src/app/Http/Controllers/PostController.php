<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Test;
use App\Models\Comment;
use Illuminate\Http\Request;
use Exception;

class PostController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        $user=auth()->user();
        return view('post.index', compact('posts', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required|max:2000',
            'image' => 'image|max:1024'
        ]);


        $ogData = [];

        try {
            $url = $inputs['title'];
            $html = @file_get_contents($url);
            if ($html === false) {
                throw new Exception('Failed to retrieve content from the URL.');
            }

            $doc = new \DOMDocument();
            @$doc->loadHTML($html);
            $tags = $doc->getElementsByTagName('meta');

            foreach ($tags as $tag) {
                if ($tag->hasAttribute('property') && strpos($tag->getAttribute('property'), 'og:') === 0) {
                    $ogData[$tag->getAttribute('property')] = $tag->getAttribute('content');
                }
            }
        } catch (Exception $e) {
        }

        $post = new Post();
            $post->title=$inputs['title'];
            $post->body=$inputs['body'];
        $post->user_id=auth()->user()->id;

        if (request('image')){
            $original = request()->file('image')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('image')->move('storage/images', $name);
            $post->image = $name;
        }

        $post->og_title = $ogData['og:title'] ?? null;
        $post->og_description = $ogData['og:description'] ?? null;
        $post->og_image = $ogData['og:image'] ?? null;

        $post->save();
        return redirect()->route('post.index')->with('message', '投稿を作成しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $inputs=$request->validate([
            'title' => 'required|max:255',
            'body' => 'required|max:1000',
            'image' => 'image|max:1024'
        ]);

        try {
            $url = $inputs['title'];
            $html = @file_get_contents($url);
            if ($html === false) {
                throw new Exception('Failed to retrieve content from the URL.');
            }

            $doc = new \DOMDocument();
            @$doc->loadHTML($html);
            $tags = $doc->getElementsByTagName('meta');

            foreach ($tags as $tag) {
                if ($tag->hasAttribute('property') && strpos($tag->getAttribute('property'), 'og:') === 0) {
                    $ogData[$tag->getAttribute('property')] = $tag->getAttribute('content');
                }
            }
        } catch (Exception $e) {
        }

        $post->title=$inputs['title'];
        $post->body=$inputs['body'];

        if(request('image')){
           $original=request()->file('image')->getClientOriginalName();
           $name=date('Ymd_His').'_'.$original;
           $file=request()->file('image')->move('storage/images', $name);
           $post->image=$name;
        }

        $post->og_title = $ogData['og:title'] ?? null;
        $post->og_description = $ogData['og:description'] ?? null;
        $post->og_image = $ogData['og:image'] ?? null;

        $post->save();

        return redirect()->route('post.show', $post)->with('message', '投稿を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->comments()->delete();
        $post->delete();
        return redirect()->route('post.index')->with('message', '投稿を削除しました');
    }

    public function mypost() {

        $user=auth()->user()->id;
        $posts=Post::where('user_id', $user)->orderBy('created_at', 'desc')->paginate(5);
        return view('post.mypost', compact('posts', 'user'));
    }

    public function mycomment() {
        $user=auth()->user()->id;
        $comments=Comment::where('user_id', $user)->orderBy('created_at', 'desc')->paginate(5);
        return view('post.mycomment', compact('comments'));
    }

    public function myProfile(){
        $user=auth()->user();
        return view('post.myProfile', compact('user'));
    }

    public function yourProfile(User $user){
        return view('post.yourProfile', compact('user'));
    }

    public function search(Request $request) {
        $query = $request->input('query');
        $posts = Post::where('og_title', 'like', "%$query%")
            ->orWhere('og_description', 'like', "%$query%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('post.search_results', compact('posts'));
    }


    public function info(){
        return view('post.info');
    }


}
