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
        Blade::directive('loginKitVersion', fn (): string => '<?php echo \\' . static::class . '::getFilamentVersion(); ?>');
    }

    /**
     * Detect installed Filament version
     */
    public static function getFilamentVersion(): string
    {
        $forcedVersion = (string) config('login-kit.force_version', '');

        if (in_array($forcedVersion, ['3', '4', '5'], true)) {
            return $forcedVersion;
        }

        foreach (['filament/filament', 'filament/panels'] as $packageName) {
            $detectedVersion = static::detectMajorVersionFromPackage($packageName);

            if ($detectedVersion !== null) {
                return $detectedVersion;
            }
        }

        // Fallback: class-based detection when composer metadata is unavailable.
        if (class_exists('Filament\Pages\Auth\Login')) {
            return '3';
        }

        if (class_exists('Filament\Auth\Pages\Login')) {
            return '4';
        }

        return '5';
    }

    protected static function detectMajorVersionFromPackage(string $packageName): ?string
    {
        try {
            if (! InstalledVersions::isInstalled($packageName)) {
                return null;
            }

            $version = InstalledVersions::getPrettyVersion($packageName) ?? InstalledVersions::getVersion($packageName);

            if (! is_string($version)) {
                return null;
            }

            if (preg_match('/(^|[^0-9])(3|4|5)(?:\\.x|\\.|$)/', $version, $matches)) {
                return $matches[2];
            }
        } catch (\Throwable) {
            return null;
        }

        return null;
    }
}
