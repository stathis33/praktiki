<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%log}}`.
 */
class m250514_083719_create_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
{
 
    $this->createTable('log_table', [
        'changed_by' => $this->integer(),
        'id' => $this->primaryKey(),
        'table_name' => $this->string()->notNull(),
        'primary_key' => $this->string()->notNull(),
        'attribute' => $this->string()->notNull(),
        'old_value' => $this->text(),
        'new_value' => $this->text(),
        'changed_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        
    ]);
}


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%log}}');
    }
}
