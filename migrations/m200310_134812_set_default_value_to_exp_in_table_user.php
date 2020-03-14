<?php

use yii\db\Migration;

/**
 * Class m200310_134812_set_default_value_to_exp_in_table_user
 */
class m200310_134812_set_default_value_to_exp_in_table_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
      $this->alterColumn("user", "exp", $this->integer()->notNull()->defaultValue(10));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
      $this->alterColumn("user", "exp", $this->integer()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200310_134812_set_default_value_to_exp_in_table_user cannot be reverted.\n";

        return false;
    }
    */
}
