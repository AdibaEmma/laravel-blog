<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Http\Request;


class PostController extends Controller
{
    // public function __construct() {

    //     $this->middleware(['auth']);

    // }

    public function index() {

        $posts = Post::latest()->with(['user', 'likes'])->paginate(20); // get all posts.

        
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'body' => 'required'
        ]);

       $request->user()->posts()->create($request->only('body'));

       return back();
    }

    public function destroy(Post $post) {
         
        $this->authorize('delete', $post);

        $post->delete();

        return back();
    }
}
