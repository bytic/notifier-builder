<?php

namespace ByTIC\NotifierBuilder;

use ByTIC\PackageBase\BaseBootableServiceProvider;

/**
 * Class NotifierBuilderProvider
 * @package ByTIC\NotifierBuilder
 */
class NotifierBuilderProvider extends BaseBootableServiceProvider
{
    public const NAME = 'notifier-builder';

    public function migrations()
    {
        return dirname(__DIR__) . '/migrations/';
    }
}
