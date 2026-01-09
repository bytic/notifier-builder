<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder;

use ByTIC\NotifierBuilder\Console\Commands\EventsSend;
use ByTIC\NotifierBuilder\Utility\PackageConfig;
use ByTIC\NotifierBuilder\Utility\PathsHelpers;
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

    protected function translationsPath(): string
    {
        return PathsHelpers::lang();
    }

    protected function registerCommands()
    {
        $this->commands(
            EventsSend::class
        );
    }
}
