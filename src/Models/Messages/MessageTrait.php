<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Models\Messages;

use ByTIC\NotifierBuilder\Models\Recipients\RecipientTrait as Recipient;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use Nip\Records\AbstractModels\Record;

/**
 * Class Topic.
 *
 * @property int $id_topic
 * @property string $recipient
 * @property string $channel
 * @property string $subject
 * @property string $content
 *
 * @method Record getParentRecord()
 */
trait MessageTrait
{
    protected ?string $subject = null;
    protected ?string $content = null;
    protected ?string $channel = null;

    protected ?int $parent_id = null;
    protected ?string $parent_type = null;

    public function getName(): ?string
    {
        return $this->getSubject();
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getChannel(): ?string
    {
        return $this->channel;
    }

    public function hasParentRecord(): bool
    {
        return $this->parent_id != null || $this->parent_type != null;
    }

    /**
     * @return Recipient|false|Record
     */
    public function getNotificationRecipient()
    {
        $params = [];
        $params['where'][] = ['`id_topic` = ?', $this->id_topic];
        $params['where'][] = ['`recipient` = ?', $this->recipient];
        $recipientsTable = NotifierBuilderModels::recipients();

        return $recipientsTable->findOneByParams($params);
    }
}
