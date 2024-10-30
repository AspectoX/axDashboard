<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Session\Middleware\AuthenticateSession;
use Laravel\Jetstream\Http\Controllers\TeamInvitationController;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/login', '/admin/login')->name('login');

Route::redirect('/register', '/admin/register')->name('register');

Route::redirect('/dashboard', '/admin')->name('admin');

Route::get('/team-invitations/{invitation}', [TeamInvitationController::class, 'accept'])
    ->middleware(['signed', 'verified', 'auth', AuthenticateSession::class])
    ->name('team-invitations.accept');
