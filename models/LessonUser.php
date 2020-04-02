<?php

namespace app\models;

use app\models\query\LessonQuery;
use app\models\query\LessonUserQuery;
use app\models\query\UserQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "lesson_user".
 *
 * @property int $lesson_id
 * @property int $user_id
 *
 * @property Lesson $lesson
 * @property User $user
 */
class LessonUser extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lesson_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lesson_id', 'user_id'], 'required'],
            [['lesson_id', 'user_id'], 'integer'],
            [['lesson_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lesson::class, 'targetAttribute' => ['lesson_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lesson_id' => 'Lesson ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Lesson]].
     *
     * @return ActiveQuery|LessonQuery
     */
    public function getLesson()
    {
        return $this->hasOne(Lesson::class, ['id' => 'lesson_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return LessonUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LessonUserQuery(get_called_class());
    }
}
