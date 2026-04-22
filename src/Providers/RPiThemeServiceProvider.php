<?php

namespace ProjectSaturnStudios\Themes\RPiTheme\Providers;

use ProjectSaturnStudios\Themes\RPiTheme\Console\Commands\UpdateVueAssets;
use ProjectSaturnStudios\LaravelDesignPatterns\Providers\BaseServiceProvider;

class RPiThemeServiceProvider extends BaseServiceProvider
{
    protected string $short_name = 'rpi-theme';

    protected array $config = [
        'themes.available.rpi-theme' => __DIR__.'/../../config/themes/rpi-theme.php',
    ];

    protected array $publishable_config = [];

    protected array $routes = [];

    protected array $commands = [
        UpdateVueAssets::class,
    ];

    protected array $bootables = [];

    protected array $migrations = [];

    protected array $projections = [];

    public function register(): void
    {
        parent::register();
        $this->publishMigrations();
    }

    protected function mainBooted(): void
    {
        $this->registerViews();
    }

    protected function registerViews(): void
    {
        $dir = base_path('resources/themes/rpi-theme');

    }

    public function publishMigrations(): void
    {
        foreach ($this->migrations as $module_table_name) {
            $modules = collect(scandir(base_path('database/migrations')))->filter(function ($item) use ($module_table_name) {
                return str_contains($item, "create_{$module_table_name}_table");
            })->toArray();

            if (empty($modules)) {
                $timestamp = date('Y_m_d_His', time());
                $stub = __DIR__."/../../database/migrations/create_{$module_table_name}_table.php";
                $target = $this->app->databasePath().'/migrations/'.$timestamp."_create_{$module_table_name}_table.php";

                $this->publishes([$stub => $target], "themes.{$this->short_name}.migrations.all");
                $this->publishes([$stub => $target], "themes.{$this->short_name}.migrations.{$module_table_name}");
            }
        }
    }
}
