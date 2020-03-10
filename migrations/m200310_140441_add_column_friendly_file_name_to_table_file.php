<?php

use yii\db\Migration;

/**
 * Class m200310_140441_add_column_friendly_file_name_to_table_file
 */
class m200310_140441_add_column_friendly_file_name_to_table_file extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
      $this->addColumn("file", "friendly_file_name", $this->string(50)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
      $this->dropColumn("file", "friendly_file_name");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200310_140441_add_column_friendly_file_name_to_table_file cannot be reverted.\n";

        return false;
    }
    */
}
