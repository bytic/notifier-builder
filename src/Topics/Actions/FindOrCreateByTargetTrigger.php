<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Topics\Actions;

use ByTIC\NotifierBuilder\Topics\Models\Topic;
use ByTIC\NotifierBuilder\Topics\Models\Topics;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use Nip\Records\AbstractModels\Record;
use Nip\Records\RecordManager;

/**
 *
 */
class FindOrCreateByTargetTrigger
{
    /**
     * @var Topics|RecordManager
     */
    protected RecordManager $topicsRepostitory;

    /**
     * @param $topicsRepository
     */
    public function __construct($topicsRepository = null)
    {
        $this->topicsRepostitory = $topicsRepository ?? NotifierBuilderModels::topics();
    }

    /**
     * @param string $target
     * @param string $trigger
     * @return Topic
     */
    public static function for($target, $trigger): Record
    {
        $self = new self();
        $find = $self->find($target, $trigger);
        if ($find) {
            return $find;
        }

        return $self->create($target, $trigger);
    }

    /**
     * @param $target
     * @param $trigger
     * @return mixed
     */
    protected function find($target, $trigger)
    {
        $params = [
            'where' => [
                ['`target` = ?', $target],
                ['`trigger` = ?', $trigger],
            ],
        ];
        return $this->topicsRepostitory->findOneByParams($params);
    }

    /**
     * @param $target
     * @param $trigger
     * @return Record
     */
    protected function create($target, $trigger): Record
    {
        $data = [
            'target' => $target,
            'trigger' => $trigger,
        ];
        $topic = $this->topicsRepostitory->getNewRecord($data);
        $topic->save();

        return $topic;
    }
}
