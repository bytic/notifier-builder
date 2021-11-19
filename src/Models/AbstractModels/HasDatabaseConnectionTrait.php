<?php

namespace ByTIC\NotifierBuilder\Models\AbstractModels;

use ByTIC\NotifierBuilder\Utility\PackageConfig;
use Nip\Database\Connections\Connection;

/**
 * Trait HasDatabaseConnectionTrait
 * @package ByTIC\NotifierBuilder\Models\AbstractModels
 */
trait HasDatabaseConnectionTrait
{

    /**
     * @return Connection
     */
    protected function newDbConnection()
    {
        return app('db')->connection(PackageConfig::databaseConnection());
    }
}

