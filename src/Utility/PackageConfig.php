<?php

namespace ByTIC\NotifierBuilder\Utility;

use ByTIC\NotifierBuilder\NotifierBuilderProvider;
use Exception;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class PackageConfig.
 */
class PackageConfig extends \ByTIC\PackageBase\Utility\PackageConfig
{
    use SingletonTrait;
    protected $name = NotifierBuilderProvider::NAME;

    /**
     * @throws Exception
     */
    public static function databaseConnection(): ?string
    {
        return (string) static::instance()->get('database.connection');
    }

    public static function shouldRunMigrations(): bool
    {
        return false !== static::instance()->get('database.migrations', false);
    }
}
