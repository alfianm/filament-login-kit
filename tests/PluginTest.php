<?php

namespace AlfianM\FilamentLoginKit\Tests;

use AlfianM\FilamentLoginKit\LoginKitPlugin;
use AlfianM\FilamentLoginKit\LoginKitServiceProvider;
use PHPUnit\Framework\TestCase;

class PluginTest extends TestCase
{
    public function test_plugin_can_be_instantiated()
    {
        $plugin = LoginKitPlugin::make();

        $this->assertInstanceOf(LoginKitPlugin::class, $plugin);
    }

    public function test_plugin_has_correct_id()
    {
        $plugin = LoginKitPlugin::make();

        $this->assertEquals('filament-login-kit', $plugin->getId());
    }

    public function test_plugin_has_required_methods()
    {
        $plugin = LoginKitPlugin::make();

        $this->assertTrue(method_exists($plugin, 'register'));
        $this->assertTrue(method_exists($plugin, 'boot'));
        $this->assertTrue(method_exists($plugin, 'getId'));
        $this->assertTrue(method_exists($plugin, 'make'));
    }

    public function test_version_detection_method_exists()
    {
        $this->assertTrue(method_exists(LoginKitServiceProvider::class, 'getFilamentVersion'));
    }

    public function test_get_filament_version_method_is_callable()
    {
        // Just test that we can call the method without error
        // We won't assert on the return value since it requires Laravel bootstrapping
        $this->assertIsCallable([LoginKitServiceProvider::class, 'getFilamentVersion']);
    }
}
