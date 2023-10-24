<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function Likepost(Request $request) {


    //Verify if user liked post

    $like = Like::where('user_id', $request->user_id)->where([['likeable_id', $request->post_id], ['likeable_type', 'App\Models\Post']])->first();
    if($like){
        //remove like from morph table
       $like->delete();
       return response()->json([
            "success" => true,
            "message" => 'Post Disliked'
        ]);

    } else {
        $like = Like::create([
            'user_id'=> $request->user_id,
            'post_id' => $request->post_id,
            'likeable_type' => 'App\Models\Post',
            'likeable_id' => $request->post_id
        ]);

        $like->save();
        return response()->json([
            "success" => true,
            "messagge" => 'Post Liked',
            "data" => $like
        ]);
    }

    // if ($like->user_id != $request->user_id) {

    // $like = Like::create([
    //     "user_id"=> $request->user()->id,
    // ]);

    // $like->save();

    // return response()->json([
    // "success" => true,
    // "message" => 'Post Liked Correctly'
    // ]);

    }
}
