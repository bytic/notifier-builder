<?php
declare(strict_types=1);

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

    public static function configPath(): string
    {
        return PathsHelpers::config('/notifier-builder.php');
    }

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
