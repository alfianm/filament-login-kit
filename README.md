# Filament Login Kit

Beautiful, customizable login layouts for **Filament v3, v4, and v5**. Transform your login page with split layouts, overlays, and flexible positioning.

![Filament Login Kit Preview](https://raw.githubusercontent.com/alfianm/filament-login-kit/main/preview.png)

## ✨ Features

- 🎨 **Multiple Layouts**: Split (2-column) and Overlay (full background) modes
- 📐 **Flexible Positioning**: Image left/right, form top/center/bottom
- 🎯 **Background Control**: Position, size, and overlay opacity
- 📱 **Responsive**: Mobile-first design
- 🌙 **Dark Mode**: Automatic dark mode support
- ⚡ **Zero Build**: Works without npm/yarn
- 🔧 **Easy Config**: Simple method chaining
- 🔄 **Multi-Version**: Supports Filament v3, v4, and v5
- 🚀 **Laravel 13 Compatible**: Tested and working with Laravel 13
- 🐘 **PHP 8.3 Support**: Fully compatible with PHP 8.3

## 📦 Installation

```bash
composer require alfianm/filament-login-kit
```

### Requirements

| Filament Version | PHP Version | Package Version |
|-----------------|-------------|-----------------|
| v3.x | ^8.1 | ^1.0 |
| v4.x | ^8.2 | ^1.0 |
| v5.x | ^8.2 | ^1.0 |

## 🚀 Quick Start

Add to your Panel Provider:

```php
use AlfianM\FilamentLoginKit\LoginKitPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            LoginKitPlugin::make(),
        ]);
}
```

## 🎨 Layout Examples

### Split Layout (Default)
```php
LoginKitPlugin::make()
    ->sideImage(asset('images/login-bg.jpg'))
    ->sideImagePosition('left')  // or 'right'
```

### Overlay Layout
```php
LoginKitPlugin::make()
    ->layoutMode('overlay')
    ->sideImage(asset('images/background.jpg'))
    ->overlayOpacity(0.6)
```

### Complete Customization
```php
LoginKitPlugin::make()
    ->sideImage(asset('images/office.jpg'))
    ->sideImagePosition('right')
    ->backgroundPosition('top')
    ->formPosition('center')
    ->formAlignment('left')
    ->heading('Welcome Back')
    ->subheading('Sign in to continue'),
```

## 📚 Configuration Options

| Method | Description | Default |
|--------|-------------|---------|
| `sideImage()` | Background image URL | `asset('images/login-kit/side-image.jpg')` |
| `sideImagePosition()` | `'left'` or `'right'` | `'left'` |
| `backgroundPosition()` | CSS position value | `'center'` |
| `backgroundSize()` | `'cover'`, `'contain'`, etc | `'cover'` |
| `formPosition()` | `'center'`, `'top'`, `'bottom'` | `'center'` |
| `formAlignment()` | `'left'`, `'center'`, `'right'` | `'center'` |
| `layoutMode()` | `'split'` or `'overlay'` | `'split'` |
| `overlayOpacity()` | `0.0` to `1.0` | `0.5` |
| `heading()` | Custom heading | `'Sign in'` |
| `subheading()` | Custom subheading | `null` |

## 🔧 Version Compatibility

### Filament v3
```php
// app/Providers/Filament/AdminPanelProvider.php
use AlfianM\FilamentLoginKit\LoginKitPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            LoginKitPlugin::make()
                ->sideImage(asset('images/login-v3.jpg'))
                ->sideImagePosition('left'),
        ]);
}
```

### Filament v4
```php
// app/Providers/Filament/AdminPanelProvider.php
use AlfianM\FilamentLoginKit\LoginKitPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            LoginKitPlugin::make()
                ->sideImage(asset('images/login-v4.jpg'))
                ->layoutMode('split'),
        ]);
}
```

### Filament v5
```php
// app/Providers/Filament/AdminPanelProvider.php
use AlfianM\FilamentLoginKit\LoginKitPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            LoginKitPlugin::make()
                ->sideImage(asset('images/login-v5.jpg'))
                ->layoutMode('overlay')
                ->overlayOpacity(0.6),
        ]);
}
```

## 📁 File Structure

Place your login background image at:
```
public/images/login-kit/side-image.jpg
```

## 🔧 Publishing Assets

### Views
```bash
php artisan vendor:publish --tag=filament-login-kit-views
```

### Config
```bash
php artisan vendor:publish --tag=filament-login-kit-config
```

## 🎨 Customization Examples

### Different Images for Different Versions
```php
LoginKitPlugin::make()
    ->sideImage(match(LoginKitServiceProvider::getFilamentVersion()) {
        '3' => asset('images/login-v3.jpg'),
        '4' => asset('images/login-v4.jpg'),
        default => asset('images/login-v5.jpg'),
    }),
```

### Mobile-Optimized Layout
```php
LoginKitPlugin::make()
    ->layoutMode('split')
    ->formPosition('center')
    ->backgroundPosition('center top'),
```

### Dark Theme Optimized
```php
LoginKitPlugin::make()
    ->layoutMode('overlay')
    ->overlayOpacity(0.7)
    ->sideImage(asset('images/dark-bg.jpg')),
```

## 🐛 Troubleshooting

### Version Detection Issues
If the plugin doesn't detect your Filament version correctly, you can force it:

```php
// In config/login-kit.php
'force_version' => '5', // or '4', '3'
```

### Views Not Loading
Clear the view cache:
```bash
php artisan view:clear
```

### CSS Not Applied
Make sure you're extending the correct layout:
```php
protected static string $layout = 'filament-login-kit::components.layout.login';
```

## 📝 Changelog

See [CHANGELOG.md](CHANGELOG.md) for detailed changes.

## 🤝 Contributing

Contributions are welcome! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## 📄 License

MIT License. See [LICENSE](LICENSE) for details.

## 🙏 Credits

Created with ❤️ for the Filament community.

## 🔗 Links

- [Documentation](https://github.com/alfianm/filament-login-kit/wiki)
- [Report Issues](https://github.com/alfianm/filament-login-kit/issues)
- [Releases](https://github.com/alfianm/filament-login-kit/releases)
