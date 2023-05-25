<?php

declare(strict_types=1);

use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use Phinx\Migration\AbstractMigration;

final class NotificationRecipientsTopicFk extends AbstractMigration
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
        $table_topics = NotifierBuilderModels::topicsTable();
        $table = $this->table($table_recipients);

        $table
            ->addForeignKey(
                'id_topic',
                $table_topics,
                'id',
                [
                    'constraint' => $table_recipients . '_id_topic',
                    'delete' => 'NO_ACTION',
                    'update' => 'NO_ACTION'
                ]
            )
            ->save();
    }
}
