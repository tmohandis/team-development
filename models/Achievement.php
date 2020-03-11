<?php

namespace app\models;

use app\models\query\AchievementQuery;
use app\models\query\UserAchievementQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "achievement".
 *
 * @property int $id
 * @property string $achievement_name
 * @property string $achievement_description
 *
 * @property UserAchievement[] $userAchievements
 */
class Achievement extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'achievement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['achievement_name', 'achievement_description'], 'required'],
            [['achievement_description'], 'string', 'max' => 1000],
            [['achievement_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'achievement_name' => 'Achievement Name',
            'achievement_description' => 'Achievement Description',
        ];
    }

    /**
     * Gets query for [[UserAchievements]].
     *
     * @return ActiveQuery|UserAchievementQuery
     */
    public function getUserAchievements()
    {
        return $this->hasMany(UserAchievement::class, ['achievement_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return AchievementQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AchievementQuery(get_called_class());
    }
}
