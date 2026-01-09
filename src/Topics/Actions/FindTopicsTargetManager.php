<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Topics\Actions;

use Bytic\Actions\Action;
use Bytic\Actions\Behaviours\HasSubject\HasSubject;
use ByTIC\Memoize\Traits\Memoizable;
use ByTIC\NotifierBuilder\Topics\Dto\TopicTarget;
use InvalidArgumentException;
use Nip\Records\Locator\ModelLocator;

/**
 *
 */
class FindTopicsTargetManager extends Action
{
    use HasSubject;
    use Memoizable;

    public function handle()
    {
        return $this->memoizeWithMethod(
            $this->getTargetName(),
            'findTargetManager'
        );
    }

    /**
     * @return string
     */
    public function getTargetName(): string
    {
        $subject = $this->getSubject();
        if (is_string($subject)) {
            return $subject;
        }
        if (is_object($subject)) {
            return $subject->getTarget();
        }
        throw new InvalidArgumentException('Subject must be string or object with getTarget method');
    }

    public function findTargetManager()
    {
        $targetName = $this->getTargetName();
        if (str_contains($targetName, TopicTarget::NAMESPACE_SEPARATOR)) {
            list($namespace, $target) = explode(TopicTarget::NAMESPACE_SEPARATOR, $targetName);
        } else {
            $namespace = null;
            $target = $targetName;
        }

        if (ModelLocator::has($target)) {
            return ModelLocator::get($target);
        }
        return null;
    }
}