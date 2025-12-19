<?php

declare(strict_types=1);

use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use Phinx\Migration\AbstractMigration;

/**
 * Class MessagesParentField
 */
final class MessagesParentField extends AbstractMigration
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
    public function change(): void
    {
        $table_name = NotifierBuilderModels::messagesTable();
        $table = $this->table($table_name);
        $table
            ->addColumn('parent_id', 'integer', ['null' => true, 'after' => 'id_topic'])
            ->addColumn('parent_type', 'string', ['null' => true, 'after' => 'parent_id']);

        $table->addIndex(['id_topic', 'parent_id', 'parent_type', 'recipient', 'channel'], ['unique' => true]);
        $table->addIndex(['parent_id']);
        $table->addIndex(['parent_type']);

        $table->save();
    }
}
