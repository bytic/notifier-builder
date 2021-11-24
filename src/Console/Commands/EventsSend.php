<?php

namespace ByTIC\NotifierBuilder\Console\Commands;

use ByTIC\Console\Command;
use ByTIC\NotifierBuilder\Models\Events\Event;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use Exception;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class EventsSend
 * @package Nip\NotifierBuilder\Console\Commands
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
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $result = $this->handle();
        $output->writeln("Sent [{$result}] events");
        return 0;
    }

    /**
     * @return int
     */
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
     * @return \Nip\Records\Collections\Collection
     */
    protected function getNextEvents()
    {
        return NotifierBuilderModels::events()->findByParams(
            [
                'where' => ['`status` = \'pending\' '],
                'limit' => 10,
            ]
        );
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
