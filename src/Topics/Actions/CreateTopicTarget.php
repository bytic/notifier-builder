<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Topics\Actions;

use Bytic\Actions\Action;
use ByTIC\NotifierBuilder\Topics\Dto\TopicTarget;
use InvalidArgumentException;
use Nip\Records\AbstractModels\Record;

/**
 *
 */
class CreateTopicTarget extends Action
{
    protected $return;

    public function __construct()
    {
        $this->return = new TopicTarget();
    }

    public static function from($target)
    {
        $return = new self();
        $return->parseTarget($target);
        return $return;
    }

    /**
     * @param $target
     * @return $this
     */
    protected function parseTarget($target): void
    {
        if ($target instanceof TopicTarget) {
            $this->return = $target;
            return;
        }
        if (is_string($target)) {
            $this->return->setRepository($target);
            return;
        }
        if (is_array($target)) {
            $this->parseTargetArray($target);
            return;
        }
        if ($target instanceof Record) {
            $this->return->setRepository($target->getManager()->getMorphName());
            return;
        }
        throw new InvalidArgumentException('Invalid target type');
    }

    protected function parseTargetArray(array $target): void
    {
        if (isset($target['repository'])) {
            $this->return->setRepository($target['repository']);
        }
        if (isset($target['namespace'])) {
            $this->return->setNamespace($target['namespace']);
        }
    }

    public function withNamespace($namespace)
    {
        $this->return->setNamespace($namespace);
        return $this;
    }

    public function get()
    {
        return $this->return;
    }
}