<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/dashboard');

Route::get('/gate', function() {
    $false = Gate::allows('allow-page', 'tigr');
    $true = Gate::allows('allow-page', 'gate');

    $isTest = Gate::allowIf(function(User $user) {
        return $user->name === 'Tigr';
    });

    return 'test gate';
});


Route::get('/policy', function() {
    $myPost = Post::where('user_id', Auth::user()->id)->first();
    $notMyPost = Post::where('user_id', '<>', Auth::user()->id)->first();

    $myPostAllow = Gate::allows('update', $myPost);
    $otherPostAllow = Gate::allows('update', $notMyPost);

    return [
        'my_post' => $myPostAllow,
        'not_my'    => $otherPostAllow,
    ];
});

Route::get('/post-update/{post}', function(Request $request, Post $post) {
  /*  if ($request->user()->cannot('update', $post)) {
        abort(403);
    }*/

    return $post->content;
})->middleware('can:update,post');

Route::group(['prefix' => 'database'], function() {
    Route::get('/', function(Request $request) {
        $limit = $request->input('per-page', 10);
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $limit;

        $users = DB::select("SELECT * FROM users LIMIT ? OFFSET ?", [$limit, $offset]);
        $count = DB::scalar("SELECT COUNT(*) FROM users");
        $pageCount = (int)ceil($count / $limit);

        return view('database.select', [
            'users' => $users,
            'total'  => $count,
            'pageCount' => $pageCount
        ]);
    });

    Route::get('/builder', function() {
        $post = DB::table('posts')->find(2);
        $countPosts = DB::table('posts')->where('user_id', 1)->ddRawSql();
        dd($countPosts);
    });

    Route::get('/paginate', function() {
        $users = DB::table('users')->paginate(10);

        return view('database.paginate', [
            'users' => $users,
        ]);
    });

    Route::get('/redis', function(Request $request) {

        $work = Redis::get('test');
        $name = $request->input('name', 'Tigr');
        Redis::publish('my-test', json_encode([
            'name'  => $name,
            'date'  => date('Y-m-d H:i:s')
        ]));


        return 'redis';
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
