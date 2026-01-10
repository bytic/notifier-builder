<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class NotificationsTableUpdates extends AbstractMigration
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
        $table = $this->table('notifications-messages');
        if ($table->exists()) {
            $table->rename('notifications-templates');
            $table->save();
        }

        $table = $this->table('notifications-events');
        if ($table->hasColumn('id_item')) {
            $this->changeItemStructure($table);
            $this->execute(
                '
                UPDATE `notifications-events` 
                JOIN `notifications-topics` ON `notifications-events`.`id_topic` = `notifications-topics`.`id`
                SET `notifications-events`.`target_type` = `notifications-topics`.`target`
             '
            );
        }
    }

    protected function changeItemStructure($table)
    {
        $table->removeIndex(['id_item']);
        $table->save();

        $table->renameColumn('id_item', 'target_id');
        $table->addColumn('target_type', 'string', ['limit' => 100, 'null' => true, 'after' => 'target_id']);
        $table->addIndex(['target_type', 'target_id'], ['name' => 'idx_target_type_id']);
        $table->save();
    }
}