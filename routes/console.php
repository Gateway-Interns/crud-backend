<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment('hm?');
})->purpose('Display an inspiring quote')->hourly();
