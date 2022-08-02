<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Messages\Builder;

use ByTIC\Notifications\Messages\Builder\AbstractBuilder as GenericBuilder;
use ByTIC\Notifications\Notifiable;
use ByTIC\Notifier\Notifications\Notification;
use Nip\Records\AbstractModels\Record;
use Nip\Records\Locator\ModelLocator;

/**
 * Class AbstractBuilder.
 *
 * @method Notification getNotification
 */
abstract class EmailBuilder extends GenericBuilder
{
    use Traits\HasNotificationMessageTrait;
    use Traits\HasEmailTemplate;

    /**
     * Model of notifiable trait
     *
     * @var Record|Notifiable
     */
    protected $notifiable = null;

    /**
     * @var array|null
     */
    protected $mergeFields = null;

    /**
     * @inheritdoc
     */
    public function compile()
    {
        parent::compile();
        $this->compileMergeFields();
    }

    public function compileMergeFields()
    {
        $mergeFields = $this->getMergeFields();
        foreach ($mergeFields as $group => $fields) {
            foreach ($fields as $field) {
                $this->setMergeTag($field, $this->getMergeFieldValue($field));
            }
        }
    }

    /**
     * @return array
     */
    public function getMergeFields()
    {
        if ($this->mergeFields === null) {
            $this->mergeFields = $this->generateMergeFields();
        }

        return $this->mergeFields;
    }

    /**
     * Generates the MergeFields array
     *
     * @return array
     */
    public function generateMergeFields()
    {
        return [];
    }

    /** @noinspection PhpUnusedParameterInspection
     *
     * Get the MergeField value
     *
     * @param string $field Field Name
     *
     * @return null
     */
    public function getMergeFieldValue($field)
    {
        return null;
    }

    /**
     * @param EmailTrait $email
     * @return mixed
     */
    protected function hydrateEmail($email)
    {
        $notifiable = $this->getNotifiable();
        if (is_object($notifiable) && method_exists($notifiable, 'routeNotificationFor')) {
            $email->to = $this->getNotifiable()->routeNotificationFor('mail');
        }
        return parent::hydrateEmail($email);
    }

    /**
     * Set the Notifiable instance
     *
     * @return Record|Notifiable
     */
    public function getNotifiable()
    {
        return $this->notifiable;
    }

    /**
     * Set the Notifiable instance
     *
     * @param Record $notifiable Notifiable record
     *
     * @return void
     */
    public function setNotifiable($notifiable)
    {
        $this->notifiable = $notifiable;
    }

    /**
     * @inheritdoc
     */
    protected function getEmailsManager()
    {
        return ModelLocator::get('emails');
    }


}
