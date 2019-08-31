<?php

use App\Postcard;
use App\PostcardSendingService;

Route::get('/', function () {
    return view('welcome');
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