<?php

namespace App\Providers\Filament;

use App\Models\User;
use App\Models\Setting;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\View\PanelsRenderHook;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->passwordReset()
            ->profile()
            ->spa()
            ->unsavedChangesAlerts()
            ->topNavigation(false)
            ->spaUrlExceptions(['*/admin/logout'])
            ->brandName('UniWorld Holidays')
            ->brandLogo(fn () => media_url(Setting::valueFor('site_logo'), 'assets/frontend/images/uniworld-logo-cropped.png'))
            ->darkModeBrandLogo(fn () => media_url(Setting::valueFor('site_logo'), 'assets/frontend/images/uniworld-logo-cropped.png'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('assets/frontend/images/uniworld-logo-cropped.png'))
            ->colors([
                'primary' => Color::hex('#064f68'),
                'gray' => Color::Gray,
                'danger' => Color::Rose,
                'warning' => Color::Orange,
                'success' => Color::Emerald,
                'info' => Color::Blue,
            ])
            ->font('Inter')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->databaseNotifications()
            ->databaseNotificationsPolling('60s')
            ->darkMode(true)
            ->sidebarCollapsibleOnDesktop()
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn () => view('filament._admin-polish'),
            )
            ->authGuard('web')
            ->authPasswordBroker('users')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                'throttle:60,1',
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
