<?php

namespace RapidCMS\Core;

use RapidCMS\Core\Commands\RapidCMSCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class RapidCMSServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('core')
            ->hasConfigFile('rapid-cms')
            ->hasViews()
            ->hasMigration('rapid_cms_core_tables')
            ->runsMigrations();
        // ->hasCommand(RapidCMSCommand::class);
    }
}
