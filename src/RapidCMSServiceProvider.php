<?php

namespace RapidCMS\Core;

use RapidCMS\Core\Commands\RapidCMSCommand;
use RapidCMS\Core\Contracts\ViewRendererInterface;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use YourPackage\Renderers\ReactViewRenderer;

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
            ->runsMigrations()
            ->hasRoutes('web');
        // ->hasCommand(RapidCMSCommand::class);

        $this->app->singleton(ViewRendererInterface::class, function ($app) {
            $ui = config('rapid-cms.stack', 'inertia-react'); // default stack

            switch ($ui) {
                // case 'inertia-vue':
                //     return new VueViewRenderer();
                // case 'livewire':
                //     return new LivewireViewRenderer();
                case 'inertia-react':
                default:
                    return new ReactViewRenderer();
            }
        });
    }
}
