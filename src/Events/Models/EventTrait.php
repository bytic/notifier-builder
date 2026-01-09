<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Events\Models;

use ByTIC\Common\Records\Emails\Builder\BuilderAwareTrait;
use ByTIC\DataObjects\Behaviors\Timestampable\TimestampableTrait;
use ByTIC\Models\SmartProperties\RecordsTraits\HasStatus\RecordTrait;
use ByTIC\NotifierBuilder\Events\Dispatcher\EventDispatcher;
use ByTIC\NotifierBuilder\Exceptions\NotificationModelNotFoundException;
use ByTIC\NotifierBuilder\Exceptions\NotificationRecipientModelNotFoundException;
use ByTIC\NotifierBuilder\Recipients\Models\RecipientTrait;
use ByTIC\NotifierBuilder\Topics\Models\TopicTrait as Topic;
use Nip\Records\AbstractModels\Record;

/**
 * Trait EventsTrait.
 *
 * @method Topic getTopic()
 *
 * @property int $id_topic
 * @property int $target_id
 * @property string $target_type
 */
trait EventTrait
{
    use RecordTrait;
    use TimestampableTrait;

    /**
     * @var string
     */
    protected static $createTimestamps = ['created'];

    /**
     * @var string
     */
    protected static $updateTimestamps = ['modified'];

    /**
     * @var Record|null
     */
    protected $model = null;

    /**
     * @return bool
     */
    public function send()
    {
        try {
            $this->sendToDispatcher();
        } catch (NotificationRecipientModelNotFoundException $exception) {
            $this->updateStatus('skipped');

            return;
        } catch (NotificationModelNotFoundException $exception) {
            $this->updateStatus('skipped');

            return;
        }
        $this->updateStatus('sent');

        return true;
    }

    /**
     * @throws NotificationModelNotFoundException
     * @throws NotificationRecipientModelNotFoundException
     */
    protected function sendToDispatcher()
    {
        EventDispatcher::create($this)->dispatch();
    }

    /**
     * @return RecipientTrait[]
     */
    public function getRecipients()
    {
        return $this->getTopic()->getRecipients();
    }

    /**
     * @param Topic $topic
     */
    public function populateFromTopic($topic)
    {
        $this->id_topic = $topic->id;
        return $this;
    }

    /**
     * @param Record $model
     */
    public function populateFromModel($model)
    {
        $this->setModel($model);
        $this->target_id = $model->id;
        $this->target_type = $model->getManager()->getMorphName();
        return $this;
    }

    /**
     * @return Record|BuilderAwareTrait
     *
     * @throws NotificationModelNotFoundException
     */
    public function getModel()
    {
        if (null === $this->model) {
            $this->initModel();
        }

        return $this->model;
    }

    /**
     * @throws NotificationModelNotFoundException
     */
    public function initModel()
    {
        $item = $this->findModel();
        if ($item instanceof Record) {
            $this->setModel($item);

            return;
        }
        throw new NotificationModelNotFoundException('Error finding item [' . $this->id_item . ']');
    }

    /**
     * @param Record|null $model
     */
    public function setModel(Record $model)
    {
        $this->model = $model;
    }

    /**
     * @return Record
     */
    public function findModel(): ?Record
    {
        $manager = $this->getTopic()->getTargetManager();

        return $manager->findOne($this->id_item);
    }
}
