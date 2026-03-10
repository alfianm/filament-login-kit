<?php

namespace AlfianM\FilamentLoginKit;

use Filament\Contracts\Plugin;
use Filament\Panel;
use AlfianM\FilamentLoginKit\Concerns\HasLoginConfiguration;

class LoginKitPlugin implements Plugin
{
    use HasLoginConfiguration;

    public function getId(): string
    {
        return 'filament-login-kit';
    }

    public function register(Panel $panel): void
    {
        // Respect user-defined login pages.
        if ($panel->hasLogin()) {
            return;
        }

        $version = LoginKitServiceProvider::getFilamentVersion();
        
        // Register appropriate login page based on Filament version
        $loginPage = match($version) {
            '3' => \AlfianM\FilamentLoginKit\Compatibility\V3\LoginPage::class,
            '4' => \AlfianM\FilamentLoginKit\Compatibility\V4\LoginPage::class,
            default => \AlfianM\FilamentLoginKit\Compatibility\V5\LoginPage::class,
        };
        
        $panel->login($loginPage);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return new static;
    }
}
