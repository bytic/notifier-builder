<?php

declare(strict_types=1);

use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use Phinx\Migration\AbstractMigration;

final class NotificationJobsTable extends AbstractMigration
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
        $tableName = NotifierBuilderModels::jobsTable();
        $table = $this->table($tableName);

        $table
            ->addColumn('topic_id', 'integer', ['null' => false, 'signed' => false])
            ->addColumn('event_id', 'integer', ['null' => false, 'signed' => false])
            ->addColumn('recipient', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('recipient_id', 'integer', ['null' => true, 'signed' => false])
            ->addColumn('template_id', 'integer', ['null' => true, 'signed' => false])
            ->addColumn('metadata', 'json', ['null' => true])
            ->addColumn(
                'channel',
                'enum',
                ['values' => ['email', 'sms', 'push', 'in_app'], 'null' => false, 'default' => 'email']
            )
            ->addColumn(
                'send_status',
                'enum',
                ['values' => ['pending', 'sent', 'failed'], 'null' => false, 'default' => 'pending']
            )
            ->addColumn(
                'read_status',
                'enum',
                ['values' => ['unread', 'read', 'archived'], 'null' => false, 'default' => 'unread']
            )
            ->addColumn('sent_at', 'datetime', ['null' => true, 'default' => null])
            ->addColumn('read_at', 'datetime', ['null' => true, 'default' => null])
            ->addTimestamps('created_at', 'updated_at')
            ->addIndex('topic_id')
            ->addIndex('event_id')
            ->addIndex(['recipient', 'recipient_id'])
            ->addIndex('template_id')
            ->addIndex('channel')
            ->addIndex('send_status')
            ->addIndex('read_status')
            ->addForeignKey(
                'topic_id',
                NotifierBuilderModels::topicsTable(),
                'id',
                ['delete' => 'CASCADE', 'update' => 'NO_ACTION']
            )
            ->addForeignKey(
                'event_id',
                NotifierBuilderModels::eventsTable(),
                'id',
                ['delete' => 'CASCADE', 'update' => 'NO_ACTION']
            )
            ->addForeignKey(
                'template_id',
                NotifierBuilderModels::messagesTable(),
                'id',
                ['delete' => 'SET_NULL', 'update' => 'NO_ACTION']
            )
            ->save();
    }
}
