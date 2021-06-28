<?php

namespace ByTIC\NotifierBuilder\Tests\Fixtures\Library;

/**
 * Class Application
 * @package ByTIC\NotifierBuilder\Tests\Fixtures\Library
 */
class Application extends \Nip\Application\Application
{

    /**
     * @inheritdoc
     */
    public function getRootNamespace()
    {
        return 'ByTIC\NotifierBuilder\Tests\Fixtures';
    }
}
