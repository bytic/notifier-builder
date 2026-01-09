<?php

declare(strict_types=1);

use ByTIC\NotifierBuilder\Channels\Dto\ChannelsEnum;
use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use Phinx\Migration\AbstractMigration;

final class NotificationRecipientsChannel extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table_recipients = NotifierBuilderModels::recipientsTable();
        $table = $this->table($table_recipients);

        $table
            ->addColumn(
                'channels',
                'set',
                [
                    'after' => 'type',
                    'default' => ChannelsEnum::EMAIL->value,
                    'null' => true,
                    'values' => [
                        ChannelsEnum::EMAIL->value,
                        ChannelsEnum::SMS->value,
                        ChannelsEnum::PUSH->value,
                        ChannelsEnum::APP->value
                    ],
                ]
            )
            ->save();
    }
}
