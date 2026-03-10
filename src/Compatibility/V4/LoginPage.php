<?php

namespace AlfianM\FilamentLoginKit\Compatibility\V4;

use AlfianM\FilamentLoginKit\LoginKitPlugin;
use Filament\Auth\Pages\Login;
use Filament\Facades\Filament;
use Illuminate\Contracts\Support\Htmlable;

/**
 * Login page for Filament v4
 * Extends: Filament\Auth\Pages\Login
 */
class LoginPage extends Login
{
    protected static string $layout = 'filament-login-kit::components.layout.login';

    public function getView(): string
    {
        return 'filament-login-kit-v4::pages.login';
    }

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
            'filamentVersion' => '4',
        ];
    }

    protected function getPlugin(): LoginKitPlugin
    {
        /** @var LoginKitPlugin $plugin */
        $plugin = Filament::getCurrentPanel()->getPlugin('filament-login-kit');
        return $plugin;
    }
}
