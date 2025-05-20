<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m250515_122214_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}',  [
        'id' => $this->primaryKey(),
        'username' => $this->string()->notNull()->unique(),
        'password_hash' => $this->string(512)->notNull(),
        'auth_key' => $this->string(32),
        'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
    ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
