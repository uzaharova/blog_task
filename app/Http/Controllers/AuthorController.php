<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Posts;
use DB;

class AuthorController extends Controller
{
    public function author_list()
    {
        $author_ips = Posts::select('author_ip', DB::raw('COUNT(author_id) as author_count'))
            ->groupby('author_ip')
            ->havingRaw('COUNT(author_id) > 1')
            ->pluck('author_ip')
            ->all();

        $authors = DB::table('authors')
            ->join('posts', 'authors.id', '=', 'posts.author_id')
            ->select('authors.login', 'posts.author_ip')
            ->wherein('posts.author_ip', $author_ips)
            ->get()
            ->toArray();

        return response()->json($authors, 200);
    }
}
