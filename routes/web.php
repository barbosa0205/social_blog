<?php

use App\Http\Controllers\LikeController;

use App\Models\Post;
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

  $recentPosts = Post::with('user.images')->with(['isLiked'])->paginate(10);

    return Inertia::render('Welcome', [
        'recentPostsProp' => $recentPosts,
    ]);
});

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
        return response()->json([
            'user' => Auth::user(),
        ]);
    } );

    //Like Routes
Route::post('/posts/like/{post_id}', [LikeController::class,'Likepost']);

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
