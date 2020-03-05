<?php

use yii\db\Migration;

/**
 * Handles adding columns to table user.
 */
class m200304_192955_add_some_column_to_user_table extends Migration
{
    protected $columnsNames = [
        'phone' => 'string',
        'about' => 'text',
        'avatar' => 'string',
    ];
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        foreach ($this->columnsNames as $columnName => $columnType) {
            $this->addColumn('user', $columnName, $this->$columnType()->defaultValue(null));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        foreach ($this->columnsNames as $columnName => $columnType) {
            $this->dropColumn('user', $columnName);
        }
    }
}
