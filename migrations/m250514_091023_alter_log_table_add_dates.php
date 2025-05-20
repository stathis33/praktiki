<?php

use yii\db\Migration;

class m250514_091023_alter_log_table_add_dates extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
$this->addColumn('log_table', 'old_date', $this->dateTime());
    $this->addColumn('log_table', 'new_date', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250514_091023_alter_log_table_add_dates cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250514_091023_alter_log_table_add_dates cannot be reverted.\n";

        return false;
    }
    */
}
