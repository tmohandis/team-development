<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lesson_category}}`.
 */
class m200304_164240_create_lesson_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lesson_category', [
            'id' => $this->primaryKey(),
            'lesson_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lesson_category');
        return true;
    }

}
