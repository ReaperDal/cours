<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

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

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('tester', function () {
    /** @var \DefStudio\Telegraph\Models\TelegraphBot $bot*/

    $bot = \DefStudio\Telegraph\Models\TelegraphBot::find(1);

    dd($bot->registerCommands([
        'setemail'=>'set your email',
        'setclassroom'=>'set clasroom',
        'setclassroomid'=>'set clasroom id'
    ])->send());
    //$this->comment(Inspiring::quote());
});

