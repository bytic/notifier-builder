<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Models\Messages;

use ByTIC\NotifierBuilder\Messages\Finders\MessagesFinder;
use ByTIC\NotifierBuilder\Models\AbstractModels\HasDatabaseConnectionTrait;
use ByTIC\NotifierBuilder\Models\Messages\MessageTrait as Message;
use ByTIC\NotifierBuilder\Models\Recipients\RecipientTrait as Recipient;
use ByTIC\NotifierBuilder\Models\Topics\TopicTrait as Topic;

/**
 * Class Messages.
 *
 * @method Message findOneByParams($params)
 */
trait MessagesTrait
{
    use HasDatabaseConnectionTrait;

    /**
     * @param string|Topic $topic
     * @param string|Recipient $recipient
     * @param string $channel
     *
     * @return Message
     */
    public static function getGlobal($topic, $recipient, $channel)
    {
        return (new MessagesFinder())->findGlobal($topic, $recipient, $channel);
    }

    /**
     * @param $topic
     * @param $recipient
     * @param $channel
     * @param $parents
     * @return mixed
     */
    public static function getGlobalByParents($topic, $recipient, $channel, $parents)
    {
        return (new MessagesFinder())->findGlobal($topic, $recipient, $channel, $parents);
    }


    protected function initRelations()
    {
        parent::initRelations();
        $this->initRelationsNotifierBuilder();
    }

    protected function initRelationsNotifierBuilder()
    {
        $this->initRelationsMessageParent();
    }

    protected function initRelationsMessageParent()
    {
        $this->morphTo('Customer', ['morphPrefix' => 'parent']);
    }

    protected function generateTable(): string
    {
        return Messages::TABLE;
    }
}
