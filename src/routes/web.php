<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
