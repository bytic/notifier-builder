<?php

namespace ByTIC\NotifierBuilder\Tests\Fixtures\Library;

/**
 * Class Application.
 */
class Application extends \Nip\Application\Application
{
    /**
     * {@inheritdoc}
     */
    public function getRootNamespace()
    {
        return 'ByTIC\NotifierBuilder\Tests\Fixtures';
    }
}
