<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lesson_commit}}`.
 */
class m200304_163409_create_lesson_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lesson_comment', [
            'lesson_id' => $this->integer()->notNull(),
            'comment_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lesson_comment');
        return true;
    }

}
