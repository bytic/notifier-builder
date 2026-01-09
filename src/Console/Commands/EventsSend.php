<?php

declare(strict_types=1);

namespace ByTIC\NotifierBuilder\Console\Commands;

use ByTIC\Console\Command;
use ByTIC\NotifierBuilder\Events\Models\Event;
use ByTIC\NotifierBuilder\Topics\Actions\FindTopicsByNamespace;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use ByTIC\NotifierBuilder\Utility\PackageConfig;
use Exception;
use Nip\Records\Collections\Collection;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class EventsSend.
 */
class EventsSend extends Command
{
    public const NAME = 'notifier-builder:events:send';

    protected function configure()
    {
        parent::configure();
        $this->setName(static::NAME);

        $this
//            ->setAliases([':cleanup'])
            ->setDescription('Send notifications events stored in DB');
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $result = $this->handle();
        $output->writeln("Sent [{$result}] events");

        return 0;
    }

    public function handle(): int
    {
        $rows = 0;
        $events = $this->getNextEvents();
        foreach ($events as $event) {
            $rows += $this->sendEvent($event);
        }

        return is_int($rows) ? $rows : 0;
    }

    /**
     * @return Collection
     */
    protected function getNextEvents()
    {
        $activeTopics = FindTopicsByNamespace::for(PackageConfig::namespace())->fetch();
        $topicIds = $activeTopics->pluck('id')->toArray();

        $params = [];
        $params['where'][] = ['`status` = \'pending\' '];
        $params['where'][] = ['`id_topic` IN ?', $topicIds];
        $params['limit'] = 10;
        return NotifierBuilderModels::events()->findByParams($params);
    }

    /**
     * @param Event $event
     */
    protected function sendEvent($event)
    {
        $output = 'send event [' . $event->id . ']';
        try {
            $event->send();
            $output .= '[' . $event->getStatus()->getName() . ']';
            $this->info($output);

            return 1;
        } catch (Exception $exception) {
            $output .= ' [ERROR SENDING: ' . $exception->getMessage() . ']';
            $this->error($output);
        }

        return 0;
    }
}
