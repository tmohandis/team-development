<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lesson_user}}`.
 */
class m200304_092121_create_lesson_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lesson_user', [
            'lesson_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lesson_user');
        return true;
    }

}
