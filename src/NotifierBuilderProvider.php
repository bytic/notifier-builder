<?php

namespace ByTIC\NotifierBuilder;

use ByTIC\Payments\Gateways\Manager;
use ByTIC\Payments\Utility\PaymentsModels;
use Nip\Container\ServiceProviders\Providers\AbstractSignatureServiceProvider;
use Nip\Container\ServiceProviders\Providers\BootableServiceProviderInterface;

/**
 * Class NotifierBuilderProvider
 * @package ByTIC\NotifierBuilder
 */
class NotifierBuilderProvider extends AbstractSignatureServiceProvider implements BootableServiceProviderInterface
{
    /**
     * @inheritdoc
     */
    public function register()
    {
    }

    /**
     * @inheritdoc
     */
    public function provides()
    {
        return [];
    }

    public function boot()
    {
        $this->getContainer()->get('migrations.migrator')->path(dirname(__DIR__) . '/migrations/');
    }
}
