<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use App\Models\Team;
use Filament\Widgets;
use Filament\PanelProvider;
use Laravel\Fortify\Fortify;
use App\Listeners\SwitchTeam;
use Filament\Events\TenantSet;
use Filament\Facades\Filament;
use Laravel\Jetstream\Features;
use App\Filament\Pages\EditTeam;
use Laravel\Jetstream\Jetstream;
use App\Filament\Pages\ApiTokens;
use Filament\Navigation\MenuItem;
use App\Filament\Pages\CreateTeam;
use Filament\Support\Colors\Color;
use App\Filament\Pages\EditProfile;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Event;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;


class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            //->login(([\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class, 'create']))
            //->registration()
            ->passwordReset()
            ->emailVerification()
            ->viteTheme('resources/css/filament/axdashboard/theme.css')
            //->viteTheme('resources/css/filament/admindash/theme.css')
            ->colors([
                'primary' => Color::Zinc,
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Profile')
                    ->icon('heroicon-o-user-circle')
                    ->url(fn () => $this->shouldRegisterMenuItem()
                        ? url(EditProfile::getUrl())
                        : url($panel->getPath())),
            ])
            //->sidebarWidth('13.75rem')
            ->topNavigation()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
                EditProfile::class,
                ApiTokens::class,
            ])
            //->profile(EditProfile::class)
            // ->renderHook(
            //     'panels::body.end',
            //     fn () => view('NavFooter'),
            // )
            ->renderHook(
                PanelsRenderHook::USER_MENU_AFTER,
                fn () => view('navTopProfile'),
            )
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->databaseNotifications()
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);

        if (Features::hasApiFeatures()) {
            $panel->userMenuItems([
                MenuItem::make()
                    ->label('API Tokens')
                    ->icon('heroicon-o-key')
                    ->url(fn () => $this->shouldRegisterMenuItem()
                        ? url(ApiTokens::getUrl())
                        : url($panel->getPath())),
            ]);
        }

        if (Features::hasTeamFeatures()) {
            $panel
                ->tenant(Team::class)
                ->tenantRegistration(CreateTeam::class)
                ->tenantProfile(EditTeam::class)
                ->userMenuItems([
                    MenuItem::make()
                        ->label('Team Settings')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->url(fn () => $this->shouldRegisterMenuItem()
                            ? url(EditTeam::getUrl())
                            : url($panel->getPath())),
                ]);
        }

        return $panel;
    }

    public function boot()
    {
        /**
         * Disable Fortify routes
         */
        Fortify::$registersRoutes = false;

        /**
         * Disable Jetstream routes
         */
        Jetstream::$registersRoutes = false;

        /**
         * Listen and switch team if tenant was changed
         */
        Event::listen(
            TenantSet::class,
            SwitchTeam::class,
        );
    }

    public function shouldRegisterMenuItem(): bool
    {
        $hasVerifiedEmail = auth()->user()?->hasVerifiedEmail();

        return Filament::hasTenancy()
            ? $hasVerifiedEmail && Filament::getTenant()
            : $hasVerifiedEmail;
    }
}
