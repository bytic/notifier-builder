<?php

declare(strict_types=1);

use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use Phinx\Migration\AbstractMigration;

final class NootificationEventsTopicFk extends AbstractMigration
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
        $table_events = NotifierBuilderModels::eventsTable();
        $table_topics = NotifierBuilderModels::topicsTable();
        $table = $this->table($table_events);

        $table
            ->addForeignKey(
                'id_topic',
                $table_topics,
                'id',
                [
                    'constraint' => $table_events . '_id_topic',
                    'delete' => 'NO_ACTION',
                    'update' => 'NO_ACTION'
                ]
            )
            ->save();
    }
}
