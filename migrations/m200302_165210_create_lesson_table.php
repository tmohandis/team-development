<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lesson}}`.
 */
class m200302_165210_create_lesson_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lesson', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull()->defaultValue(1),
            'title' => $this->string(255)->notNull(),
            'preview' => $this->string(255)->notNull(),
            'short_description' => $this->text()->notNull(),
            'description' => $this->text()->notNull(),
            'creator_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'file_id' => $this->integer(),
            'commit_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lesson');
        return true;
    }
}
