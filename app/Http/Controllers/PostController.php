<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }

    public function likePost(Request $request) {


        //Verify if user li ked post
        
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

        }

        public function commentPost(Request $request) {
            $newComment = Comment::create([
                "user_id" => $request->user_id,
                "commentable_type" => 'App\Models\Post',
                "commentable_id" => $request->post_id,
                "comment" => $request->comment
            ]);

            $newComment->save();

            $comment = Comment::where("id", $newComment->id)->with('user')->first();

            return response()->json([
                "success" => true,
                "messagge" => 'Post commented',
                "data" => $comment
            ]);
        }
}
