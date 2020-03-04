<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%commit}}`.
 */
class m200303_183747_create_commit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('commit', [
            'id' => $this->primaryKey(),
            'commit' => $this->text()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('commit');
        return true;
    }
}
