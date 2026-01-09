<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Templates\Actions\Find;

use ByTIC\NotifierBuilder\Templates\Models\TemplateTrait;
use Nip\Records\AbstractModels\Record;

/**
 *
 */
class FindOrCreateTemplatesByParents extends FindOrCreateTemplates
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
        $parentId = array_key_first($this->parents);
        $parentType = array_shift($this->parents);

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
     * @return TemplateTrait|Record|null
     */
    public function fetch()
    {
        $params = $this->findParams();
        foreach ($this->parents as $parentId => $parentType) {
            $message = $this->findByParents($parentType, $parentId, $params);
            if ($message) {
                return $message;
            }
        }
        $message = $this->findByParents(null, null, $params);
        if ($message) {
            return $message;
        }
        return $this->getDefault();
    }

    /**
     * @param $type
     * @param $id
     * @param $params
     * @return TemplateTrait|Record|null
     */
    protected function findByParents($type, $id, $params = null): TemplateTrait|Record|null
    {
        $params = $params ?? $this->findParams();
        $params['where'][] = $type === null ? ['`parent_type` IS NULL'] : ['`parent_type` = ?', $type];
        $params['where'][] = $id === null ? ['`parent_id` IS NULL'] : ['`parent_id` = ?', $id];
        return $this->findOneByParams($params);
    }
}