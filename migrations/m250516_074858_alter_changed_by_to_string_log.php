<?php

use yii\db\Migration;

class m250516_074858_alter_changed_by_to_string_log extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
$this->alterColumn('log_table', 'changed_by', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250516_074858_alter_changed_by_to_string_log cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250516_074858_alter_changed_by_to_string_log cannot be reverted.\n";

        return false;
    }
    */
}
