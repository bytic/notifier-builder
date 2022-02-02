<?php

namespace ByTIC\NotifierBuilder;

use ByTIC\NotifierBuilder\Console\Commands\EventsSend;
use ByTIC\NotifierBuilder\Utility\PackageConfig;
use ByTIC\PackageBase\BaseBootableServiceProvider;

/**
 * Class NotifierBuilderProvider.
 */
class NotifierBuilderProvider extends BaseBootableServiceProvider
{
    public const NAME = 'notifier-builder';

    public function migrations(): ?string
    {
        if (PackageConfig::shouldRunMigrations()) {
            return dirname(__DIR__) . '/migrations/';
        }

        return null;
    }

    protected function registerCommands()
    {
        $this->commands(
            EventsSend::class
        );
    }
}
