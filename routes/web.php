<?php

use App\Http\Middleware\StupidCorsRulesMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => [StupidCorsRulesMiddleware::class]], function () {
    Route::get('/', function () {
        return inertia('Home');
    })->name('home');

    Route::get('/process', fn () => redirect()->route('home'));
    Route::post('/process', 'MainController@index')->name('process');
});

Route::get('/bypass', function () {
    request()->validate(['url' => 'required']);

    return response()->streamDownload(
        fn () => readfile(request()->url),
        'videoplayback.mp4',
        [
            'Content-Type' => 'video/mp4',
            'Content-Disposition' => 'attachment; filename="videoplayback.mp4"',
        ]
    );
});
