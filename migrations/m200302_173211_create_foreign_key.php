<?php

use yii\db\Migration;

/**
 * Class m200302_173211_create_foreign_key
 */
class m200302_173211_create_foreign_key extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fx_lesson_user', 'lesson', ['creator_id'], 'user', ['id']);
        $this->addForeignKey('fx_lesson_file_many_1', 'lesson_file', ['lesson_id'], 'lesson', ['id']);
        $this->addForeignKey('fx_lesson_file_many_2', 'lesson_file', ['file_id'], 'file', ['id']);
        $this->addForeignKey('fx_lesson_commit_many_1', 'lesson_commit', ['lesson_id'], 'lesson', ['id']);
        $this->addForeignKey('fx_lesson_commit_many_2', 'lesson_commit', ['commit_id'], 'commit', ['id']);
        $this->addForeignKey('fx_lesson_user_many_1', 'lesson_user', ['lesson_id'], 'lesson', ['id']);
        $this->addForeignKey('fx_lesson_user_many_2', 'lesson_user', ['user_id'], 'user', ['id']);
        $this->addForeignKey('fx_lesson_category_many_1', 'lesson_category', ['lesson_id'], 'lesson', ['id']);
        $this->addForeignKey('fx_lesson_category_many_2', 'lesson_category', ['category_id'], 'category', ['id']);
        $this->addForeignKey('fx_user_achievement_many_1', 'user_achievement', ['user_id'], 'user', ['id']);
        $this->addForeignKey('fx_user_achievement_many_2', 'user_achievement', ['achievement_id'], 'achievement', ['id']);
        $this->addForeignKey('fx_user_commit_many_1', 'user_commit', ['user_id'], 'user', ['id']);
        $this->addForeignKey('fx_user_commit_many_2', 'user_commit', ['commit_id'], 'commit', ['id']);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fx_lesson_user','lesson');
        $this->dropForeignKey('fx_lesson_file_many_1', 'lesson_file');
        $this->dropForeignKey('fx_lesson_file_many_2', 'lesson_file');
        $this->dropForeignKey('fx_lesson_commit_many_1', 'lesson_commit');
        $this->dropForeignKey('fx_lesson_commit_many_2', 'lesson_commit');
        $this->dropForeignKey('fx_lesson_user_many_1', 'lesson_user');
        $this->dropForeignKey('fx_lesson_user_many_2', 'lesson_user');
        $this->dropForeignKey('fx_lesson_category_many_1', 'lesson_category');
        $this->dropForeignKey('fx_lesson_category_many_2', 'lesson_category');
        $this->dropForeignKey('fx_user_achievement_many_1', 'user_achievement');
        $this->dropForeignKey('fx_user_achievement_many_2', 'user_achievement');
        $this->dropForeignKey('fx_user_commit_many_1', 'user_commit');
        $this->dropForeignKey('fx_user_commit_many_2', 'user_commit');


        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200302_173211_create_foreign_key cannot be reverted.\n";

        return false;
    }
    */
}
