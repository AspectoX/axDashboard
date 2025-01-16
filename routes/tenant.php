<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Illuminate\Session\Middleware\AuthenticateSession;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Laravel\Jetstream\Http\Controllers\TeamInvitationController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin');
    });

    Route::redirect('/login', '/admin/login')->name('login');

    Route::redirect('/register', '/admin/register')->name('register');

    Route::redirect('/dashboard', '/admin')->name('admin');

    Route::get('/team-invitations/{invitation}', [TeamInvitationController::class, 'accept'])
        ->middleware(['signed', 'verified', 'auth', AuthenticateSession::class])
        ->name('team-invitations.accept');
});
