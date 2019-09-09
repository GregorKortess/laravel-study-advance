<?php

use App\Postcard;
use App\PostcardSendingService;
use Illuminate\Support\Str;

Route::get('/', function () {
//    return \Illuminate\Support\Facades\Response::errorJson();
    dd(Str::prefix('123TEst'));
});

Route::get('pay','PayOrderController@store');

Route::get('channels','ChannelController@index');
Route::get('posts/create','PostController@create');

Route::get('postcards', function () {

    $postcardService = new PostcardSendingService('USA',4,6);

    $postcardService->hello('Testing message','CortessHack@gmail.com');
});

Route::get('/facades', function () {
        Postcard::hello('Hello from facade','test@test.com');
});

