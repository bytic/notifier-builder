<?php

declare(strict_types=1);

use ByTIC\NotifierBuilder\Utility\NotifierBuilderModels;
use Phinx\Migration\AbstractMigration;

/**
 * Class CreateRecipientsTable
 */
final class CreateRecipientsTable extends AbstractMigration
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
        $table_name = NotifierBuilderModels::recipientsTable();
        $exists = $this->hasTable($table_name);
        if ($exists) {
            return;
        }
        $table = $this->table($table_name);
        $table
            ->addColumn('id_topic', 'integer')
            ->addColumn('recipient', 'string')
            ->addColumn('type', 'enum', ['values' => ['single', 'collection'], 'default' => 'single'])
            ->addColumn('active', 'enum', ['values' => ['yes', 'no'], 'default' => 'yes'])
            ->addColumn('modified', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('created', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
            ]);

        $table->addIndex(['id_topic']);
        $table->addIndex(['channel']);
        $table->addIndex(['active']);

        $table->save();
    }
}
