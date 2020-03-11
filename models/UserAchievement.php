<?php

namespace app\models;

use app\models\query\AchievementQuery;
use app\models\query\UserAchievementQuery;
use app\models\query\UserQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_achievement".
 *
 * @property int $user_id
 * @property int $achievement_id
 *
 * @property User $user
 * @property Achievement $achievement
 */
class UserAchievement extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_achievement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'achievement_id'], 'required'],
            [['user_id', 'achievement_id'], 'integer'],
            [
                ['user_id'], 'exist', 'skipOnError' => true,
                'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']
            ],
            [
                ['achievement_id'], 'exist', 'skipOnError' => true,
                'targetClass' => Achievement::class, 'targetAttribute' => ['achievement_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'achievement_id' => 'Achievement ID',
        ];
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
     * Gets query for [[Achievement]].
     *
     * @return ActiveQuery|AchievementQuery
     */
    public function getAchievement()
    {
        return $this->hasOne(Achievement::class, ['id' => 'achievement_id']);
    }

    /**
     * {@inheritdoc}
     * @return UserAchievementQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserAchievementQuery(get_called_class());
    }
}
