<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lesson_file}}`.
 */
class m200304_182809_create_lesson_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lesson_file', [
            'id' => $this->primaryKey(),
            'lesson_id' => $this->integer()->notNull(),
            'file_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lesson_file');
        return true;
    }

}
