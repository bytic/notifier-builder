<?php

namespace ByTIC\NotifierBuilder\Utility;

use ByTIC\NotifierBuilder\NotifierBuilderProvider;
use Nip\Config\Config;
use Nip\Utility\Traits\SingletonTrait;

/**
 * Class PackageConfig
 * @package ByTIC\PackageBase\Utility
 */
class PackageConfig extends \ByTIC\PackageBase\Utility\PackageConfig
{
    use SingletonTrait;
    protected $name = NotifierBuilderProvider::NAME;

    /**
     * @return string|null
     * @throws \Exception
     */
    public static function databaseConnection(): ?string
    {
        return (string) static::instance()->get('database.connection');
    }

    public static function shouldRunMigrations(): bool
    {
        return static::instance()->get('database.migrations', false) !== false;
    }
}
