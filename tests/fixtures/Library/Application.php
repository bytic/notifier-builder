<?php

declare(strict_types=1);

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
