<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Session\Middleware\AuthenticateSession;
use Laravel\Jetstream\Http\Controllers\TeamInvitationController;

Route::get('/', function () {
    return view('welcome');
});

