<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_achievement}}`.
 */
class m200304_165416_create_user_achievement_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_achievement', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'achievement_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user_achievement');
        return true;
    }

}
