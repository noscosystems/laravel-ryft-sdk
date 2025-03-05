<?php

namespace Nosco\Ryft;

use Nosco\Ryft\Commands\RyftCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class RyftServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-ryft')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigrations()
            ->hasCommand(RyftCommand::class);
    }
}
