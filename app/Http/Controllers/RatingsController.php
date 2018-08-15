<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Rating;
use DB;

class RatingsController extends Controller
{
    public function add_rating(Request $request)
    {
        if (!isset($request->post_id) || !isset($request->rating)) {
            return response()->json(__('blog.parameters_error'), 422);
        }

        $post = Posts::where(['id' => (int) $request->post_id])
            ->first();
        if (empty($post)) {
            return response()->json(__('blog.post_error'), 422);
        }

        if (!in_array($request->rating, [1, 2, 3, 4, 5])) {
            return response()->json(__('blog.rating_error'), 422);
        }

        $rating = [
            'post_id' => (int) $request->post_id,
            'rating' => (int) $request->rating,
        ];
        Rating::create($rating);

        $rating_average = number_format(
            Rating::where(['post_id' => (int) $request->post_id])
                ->average('rating'),
            2
        );

        return response()->json(['rating_average' => $rating_average], 200);
    }

    public function ratingListByCount(int $count)
    {
        $posts_ids = Rating::select('post_id', DB::raw('avg(rating) as average'))
            ->groupby('post_id')
            ->orderby('average', 'DESC')
            ->take($count)
            ->pluck('post_id');

        return $posts_ids->all();
    }
}
