<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Messages\Actions\Find;

use ByTIC\NotifierBuilder\Models\Messages\MessageTrait;
use Nip\Records\AbstractModels\Record;

/**
 *
 */
class FindOrCreateMessagesByParents extends FindOrCreateMessages
{
    protected array $parents = [];

    public function withParents(array $parents): self
    {
        $this->parents = $parents;
        return $this;
    }

    /**
     * @param array $data
     * @return array
     */
    protected function createMessageData(array $data = []): array
    {
        $parentType = array_shift($this->parents);
        $parentId = array_key_first($this->parents);

        $mergeData = [
            'parent_type' => $parentType,
            'parent_id' => $parentId,
        ];
        $globalMessage = parent::fetch();
        if ($globalMessage) {
            $mergeData['subject'] = $globalMessage->getSubject();
            $mergeData['content'] = $globalMessage->getContent();
        }

        return parent::createMessageData(array_merge($mergeData, $data));
    }

    /**
     * @return MessageTrait|Record|null
     */
    public function fetch()
    {
        $params = $this->findParams();
        foreach ($this->parents as $parentId => $parentType) {
            $paramsParent = $params;
            $paramsParent['where'][] = ['`parent_type` = ?', $parentType];
            $paramsParent['where'][] = ['`parent_id` = ?', $parentId];
            $message = $this->findOneByParams($paramsParent);
            if ($message) {
                return $message;
            }
        }
        return $this->getDefault();
    }
}