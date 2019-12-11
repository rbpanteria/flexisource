<?php

Route::get('/player/import', "PlayerController@import");
Route::get('/player/fullnames', "PlayerController@getFullnames");
Route::resource('/player', "PlayerController", ['only' => ['show']]);