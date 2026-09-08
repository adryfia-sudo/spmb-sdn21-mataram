<?php

namespace App\Providers\Filament;

use Filament\View\PanelsRenderHook;
use Filament\Navigation\NavigationItem;
use App\Filament\Widgets\RegistrationPathChart;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use App\Filament\Widgets\RegistrationStats;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
	    ->brandName('SD Negeri 21 Mataram')
	    ->brandLogo(asset('storage/school-logo/01KZQDDQHAAJGNXP5NTBJBZ8KK.png'))
            ->brandLogoHeight('4rem')
	    ->renderHook(
    		PanelsRenderHook::SIDEBAR_LOGO_AFTER,
    		fn (): string => '<div class="px-4 pb-3 text-sm font-semibold whitespace-nowrap">ADMIN SD Negeri 21 Mataram</div>',
	    )
	    ->colors([
                'primary' => Color::Blue,
            ])
	    ->navigationItems([
    	      NavigationItem::make('Website Sekolah')
        	->url(url('/school'))
        	->icon('heroicon-o-home')
        	->openUrlInNewTab(),
])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                RegistrationStats::class,
		RegistrationPathChart::class,
            ])
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
    }
}
