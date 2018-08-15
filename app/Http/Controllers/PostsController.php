<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Posts;
use App\Http\Controllers\RatingsController;
use DB;

class PostsController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')
            ->join('authors', 'posts.author_id', '=', 'authors.id')
            ->paginate(15);

        return view('welcome', ['posts' => $posts]);
    }

    public function post_create(Request $request)
    {
        if (!isset($request->title) || !isset($request->description)) {
            return response()->json(__('blog.validation_error'), 422);
        }

        $author_ip = 0;
        if (!empty($request->login)) {
            $author = Author::where(['login' => (string) $request->login])->first();

            if (empty($author)) {
                $author_id = Author::create(['login' => (string)$request->login])->getKey();
            } else {
                $author_id = $author->getKey();
            }
        }

        $post = [
            'title' => (string) $request->title,
            'description' => (string) $request->description,
            'author_ip' => empty($request->author_ip) ? '' : (string) $request->author_ip,
            'author_id' => $author_id,
        ];

        $post_id = Posts::create($post)->getKey();

        return response()->json(['post_id' => $post_id], 200);
    }

    public function top_posts(Request $request)
    {
        $ratings = new RatingsController();
        $posts_ids = $ratings->ratingListByCount((int)$request->count);

        $posts = Posts::wherein('id', $posts_ids)
            ->get(['title', 'description'])
            ->toArray();

        return response()->json($posts, 200);
    }
}