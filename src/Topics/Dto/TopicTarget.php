<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Topics\Dto;

use Stringable;

/**
 *
 */
class TopicTarget implements Stringable
{
    public const NAMESPACE_SEPARATOR = '::';
    protected ?string $namespace = null;
    protected ?string $repository = null;


    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }

    public function setRepository($repository)
    {
        $this->repository = $repository;
        return $this;
    }

    public function string(): string
    {
        return $this->__toString();
    }

    public function __toString(): string
    {
        $parts = [];
        if ($this->namespace) {
            $parts[] = $this->namespace;
        }
        if ($this->repository) {
            $parts[] = $this->repository;
        }
        return implode(self::NAMESPACE_SEPARATOR, $parts);
    }

}