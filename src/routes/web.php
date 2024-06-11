<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\RateLimiter;

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

Route::get('/', function () {
    $about = Storage::url('public/images/anime.jpeg');


    return view('homepage');
});


Route::get('/disc', function() {
   // $put = Storage::disk('local')->put('about.txt', 'Text content');
    return asset('storage/about.txt');
});


Route::name('upload')->group(function() {

    Route::get('/upload', function() {
        Storage::delete('public/images/granta');
        $files = Storage::files('public/images');


        return view('upload', ['files' => $files]);
    });

    Route::post('/upload', function(Request $request) {
        $data = $request->validate([
            'auto'  => 'file',
        ]);

        $auto = $request->file('auto');
        $name = $auto->getClientOriginalName();
        $extension = $auto->extension();
        //$path = $auto->storeAs('public/images', 'granta.' . $extension);
        $path = Storage::putFileAs('public/images/', $auto, time() . '_auto.' . $extension);


        return redirect()->route('upload', [
            'img'   => $path,
        ]);
    });
});

Route::get('/helpers', function () {
    $action =  asset('storage/images/anime.jpeg');
    $str = \Illuminate\Support\Facades\Pipeline::send('tigr')
        ->through([
            function($name, Closure $next) {
                $name = $name . '_skotina';
                return $next($name);
            },
            function($name, Closure $next) {
                $name .= '_v2';
                return $next($name);
            }
        ])->then(function($name) {
            return $name;
        });



    return "<img src='$action'>";
});

Route::get('/test', [\App\Http\Controllers\TestController::class, 'test'])->name('test');



Route::get('/image', function() {
    return 'Image';
});

Route::get('process', function() {
    $result = Process::run('cat index.php');

    return 'process';
});

Route::get('/queue', function() {
    $user = \App\Models\User::find(2);

   //\App\Jobs\ProcessTest::dispatchSync($user);
    \App\Jobs\ProcessTest::dispatch($user);

    return 'Queue';
});

Route::get('/rate-limit', function() {
   $executed = RateLimiter::attempt('send', 2, function() {
       return 'skotina';
   });

   return $executed;
});

Route::get('/str', function() {
    return class_basename(Route::class);
});
