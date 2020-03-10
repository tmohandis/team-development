<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%file}}`.
 */
class m200303_174509_create_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('file', [
            'id' => $this->primaryKey(),
            'file_name' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('file');
        return true;
    }
}
