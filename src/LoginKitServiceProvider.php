<?php

namespace AlfianM\FilamentLoginKit;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Composer\InstalledVersions;
use Illuminate\Support\Facades\Blade;

class LoginKitServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-login-kit';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasViews()
            ->hasConfigFile();
    }

    public function packageBooted(): void
    {
        // Detect Filament version and load appropriate views
        $filamentVersion = $this->getFilamentVersion();
        
        // Register views with version-specific fallback
        $this->loadViewsFrom(__DIR__ . '/../resources/views/v' . $filamentVersion, 'filament-login-kit-v' . $filamentVersion);
        $this->loadViewsFrom(__DIR__ . '/../resources/views/components', 'filament-login-kit');
        
        // Register Blade directives for version detection
        Blade::directive('loginKitVersion', function () {
            return "'" . $this->getFilamentVersion() . "'";
        });
    }

    /**
     * Detect installed Filament version
     */
    public static function getFilamentVersion(): string
    {
        try {
            $version = InstalledVersions::getVersion('filament/filament');
            
            if (str_starts_with($version, '3.')) {
                return '3';
            } elseif (str_starts_with($version, '4.')) {
                return '4';
            } elseif (str_starts_with($version, '5.')) {
                return '5';
            }
        } catch (\Exception $e) {
            // Fallback: try to detect from classes
            if (class_exists('Filament\Auth\Pages\Login')) {
                return '5'; // v5 uses Filament\Auth\Pages\Login
            } elseif (class_exists('Filament\Pages\Auth\Login')) {
                return '3'; // v3 uses Filament\Pages\Auth\Login
            }
        }
        
        // Default to v5
        return '5';
    }
}
