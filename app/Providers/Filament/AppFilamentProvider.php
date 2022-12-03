<?php

namespace App\Providers\Filament;

use App\Filament\App\Pages\RegisterTeam;
use App\Filament\Pages\Auth\Login;
use App\Models\Team;
use Filament\Context;
use Filament\ContextProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Http\Middleware\MirrorConfigToSubpackages;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AppFilamentProvider extends ContextProvider
{
    public function context(Context $context): Context
    {
        return $context
            ->id('app')
            ->path('app')
            ->login(Login::class)
            ->registration()
            ->passwordReset()
            ->emailVerification()
            ->tenant(Team::class)
            ->tenantRegistration(RegisterTeam::class)
            ->discoverResources(in: app_path('Filament/App/Resources'), for: 'App\\Filament\\App\\Resources')
            ->discoverPages(in: app_path('Filament/App/Pages'), for: 'App\\Filament\\App\\Pages')
            ->discoverWidgets(in: app_path('Filament/App/Widgets'), for: 'App\\Filament\\App\\Widgets')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DispatchServingFilamentEvent::class,
                MirrorConfigToSubpackages::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
