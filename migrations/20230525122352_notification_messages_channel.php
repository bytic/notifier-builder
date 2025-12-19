<?php

declare(strict_types=1);

use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use Phinx\Migration\AbstractMigration;

final class NotificationMessagesChannel extends AbstractMigration
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
        $tableName = NotifierBuilderModels::messagesTable();
        $table = $this->table($tableName);

        $table
            ->changeColumn(
                'channel',
                'enum',
                [
                    'values' => ['email', 'sms', 'push', 'in_app'],
                    'null' => false,
                    'default' => 'email',
                ]
            )
            ->save();
    }
}
