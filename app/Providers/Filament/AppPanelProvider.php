<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('app')
            ->path('app')
            ->login()
            ->sidebarCollapsibleOnDesktop()
            ->resourceCreatePageRedirect('index')
            ->colors([
                'primary' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->navigationGroups([
                NavigationGroup::make()->label('Dashboard'), /* Different dashboard based on role (Overview, Inventory Statistics, Sales Statistics, Purchasing Statistics, Low-Stock alerts, Pending Approvals, Recent Activity) */
                NavigationGroup::make()->label('Catalog'), /* For maintaining the products that the business sells (Products, Categories, Brands, Units) */
                NavigationGroup::make()->label('Warehousing'), /* Everything concerning physical storage (Warehouses, Warehouse Locations, Stock Transfers, Stock Counts, Inventory Adjustments) */
                NavigationGroup::make()->label('Inventory'), /* This is the actual stock management section (Inventory, Stock Movements, Inventory Adjustments, Stock Transfers, Stock Counts) */
                NavigationGroup::make()->label('Purchasing'), /* For acquiring inventory from suppliers (Suppliers, Purchase Orders, Goods Receipts) */
                NavigationGroup::make()->label('Sales'), /* For selling inventory (Customers, Sales Orders) */
                NavigationGroup::make()->label('Reports'), /* Management information rather than CRUD (Inventory Report, Stock Movement Report, Purchase Report, Sales Report, Supplier Report, Inventory Validation, Stock Variance, Low Stock Report) */
                NavigationGroup::make()->label('Administration'), /* Only system administrators (Users, Roles, Permissions, Activity Log, System Settings) */
            ]);
    }
}
