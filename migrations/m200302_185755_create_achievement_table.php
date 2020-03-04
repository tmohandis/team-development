<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%achievement}}`.
 */
class m200302_185755_create_achievement_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('achievement', [
            'id' => $this->primaryKey(),
            'achievement_name' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('achievement');
        return true;
    }
}
