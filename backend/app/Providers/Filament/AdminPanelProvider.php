<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Login;
use App\Http\Middleware\FIlament\AdminPanelLocaleMiddleware;
use App\Http\Middleware\RestrictedScrambleAccess;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Infolists\Infolist;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationGroup;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Tables\Table;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

final class AdminPanelProvider extends PanelProvider
{
    public function boot(): void
    {
        Table::$defaultDateTimeDisplayFormat = 'j M. Y H:i';
        Infolist::$defaultDateTimeDisplayFormat = 'j M. Y H:i';
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->darkMode(false)
            ->colors([
                'primary' => '#2d41f9',
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([])
            ->userMenuItems(
                array_merge(
                    [],
                    $this->scrambleDocsMenuItem(),
                )
            )
            ->navigationGroups([
                NavigationGroup::make(__('filament/navigation.blog')),
                NavigationGroup::make(__('filament/navigation.feedback')),
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                AdminPanelLocaleMiddleware::class,
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

    private function scrambleDocsMenuItem(): array
    {
        return [
            MenuItem::make()
                ->label('API Docs')
                ->url(static fn(): string => route('scramble.docs.ui'))
                ->visible(static function () {
                    return RestrictedScrambleAccess::isEnabled();
                })
                ->icon('heroicon-o-code-bracket-square'),
        ];
    }
}
