<?php

namespace AlfianM\FilamentLoginKit\Compatibility\V3;

use AlfianM\FilamentLoginKit\LoginKitPlugin;
use Filament\Pages\Auth\Login;
use Filament\Facades\Filament;
use Illuminate\Contracts\Support\Htmlable;

/**
 * Login page for Filament v3
 * Extends: Filament\Pages\Auth\Login
 */
class LoginPage extends Login
{
    protected static string $view = 'filament-login-kit-v3::pages.login';
    
    protected static string $layout = 'filament-login-kit::components.layout.login';

    public static function isSimple(): bool
    {
        return true;
    }

    public function getHeading(): string | Htmlable
    {
        $plugin = $this->getPlugin();
        return $plugin->getHeading() ?? 'Sign in';
    }

    public function getSubheading(): string | Htmlable | null
    {
        $plugin = $this->getPlugin();
        return $plugin->getSubheading();
    }

    protected function getLayoutData(): array
    {
        $plugin = $this->getPlugin();

        return [
            ...parent::getLayoutData(),
            'sideImage' => $plugin->getSideImage(),
            'sideImagePosition' => $plugin->getSideImagePosition(),
            'heading' => $this->getHeading(),
            'subheading' => $this->getSubheading(),
            'backgroundPosition' => $plugin->getBackgroundPosition(),
            'backgroundSize' => $plugin->getBackgroundSize(),
            'formPosition' => $plugin->getFormPosition(),
            'formAlignment' => $plugin->getFormAlignment(),
            'layoutMode' => $plugin->getLayoutMode(),
            'overlayOpacity' => $plugin->getOverlayOpacity(),
            'filamentVersion' => '3',
        ];
    }

    protected function getPlugin(): LoginKitPlugin
    {
        /** @var LoginKitPlugin $plugin */
        $plugin = Filament::getCurrentPanel()->getPlugin('filament-login-kit');
        return $plugin;
    }
}
