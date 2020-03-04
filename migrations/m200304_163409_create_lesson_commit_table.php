<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lesson_commit}}`.
 */
class m200304_163409_create_lesson_commit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lesson_commit', [
            'id' => $this->primaryKey(),
            'lesson_id' => $this->integer()->notNull(),
            'commit_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lesson_commit');
        return true;
    }

}
