<?php

use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

  $recentPosts = Post::with('user.images')->with(['isLiked'])->with('comments.user')->paginate(10);

    return Inertia::render('Welcome', [
        'recentPostsProp' => $recentPosts,
    ]);
});

  //Posts Routes
  Route::post('/posts/like/{post_id}', [PostController::class,'likePost']);
 Route::post('/posts/comment/{post_id}', [PostController::class,'commentPost']);


Route::get('/public-page', function() {
    return Inertia::render('Public/PublicPage', []);
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    //get user
    Route::post('/get_user', function(){
       
        $user = User::find(Auth::id());

        return response()->json([
            "user" => $user
        ]);
       
    } );

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
