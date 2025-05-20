<?php

use yii\db\Migration;

class m250516_084004_add_email_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
 $this->addColumn('user', 'email', $this->string()->notNull()->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250516_084004_add_email_to_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250516_084004_add_email_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
