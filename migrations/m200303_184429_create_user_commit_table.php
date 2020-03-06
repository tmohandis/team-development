<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_commit}}`.
 */
class m200303_184429_create_user_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_comment', [
            'comment_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user_comment');
        return true;
    }

}
