<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('importplayers', function () {
    $request = Request::create("api/player/import", 'GET');
    $this->info(app()['Illuminate\Contracts\Http\Kernel']->handle($request));
})->describe('Call api/player/import URL via console');