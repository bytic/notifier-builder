<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Topics\Actions;

use Bytic\Actions\Behaviours\Entities\FindRecord;

/**
 *
 */
class FindTopicByTargetTrigger extends AbstractAction
{
    use FindRecord;

    protected string $target;
    protected string $trigger;

    /**
     * @param $target
     * @param $trigger
     * @return self
     */
    public static function for($target, $trigger): self
    {
        $self = new self();
        $self->setTarget($target);
        $self->setTrigger($trigger);

        return $self;
    }

    /**
     * @param $target
     * @return $this
     */
    protected function setTarget($target): static
    {
        $target = $this->normalizeTarget($target);
        $this->target = $target;
        return $this;
    }

    /**
     * @param $target
     * @return string
     */
    protected function normalizeTarget($target): string
    {
        $target = CreateTopicTarget::from($target)->get();
        return (string)$target;
    }

    protected function setTrigger($trigger): static
    {
        $trigger = $this->normalizeTrigger($trigger);
        $this->trigger = $trigger;
        return $this;
    }

    /**
     * @param $trigger
     * @return string
     */
    protected function normalizeTrigger($trigger): string
    {
        return (string)$trigger;
    }

    /**
     * @return mixed
     */
    protected function findParams(): array
    {
        $params = [
            'where' => [
                ['`target` = ?', $this->target],
                ['`trigger` = ?', $this->trigger],
            ],
        ];
        return $params;
    }

    /**
     * @param $data
     * @return array
     */
    protected function orCreateData($data): array
    {
        $data = [
            'target' => $this->target,
            'trigger' => $this->trigger,
        ];

        return $data;
    }

}
