<?php

namespace app\models\query;

use app\models\UserAchievement;

/**
 * This is the ActiveQuery class for [[\app\models\UserAchievement]].
 *
 * @see \app\models\UserAchievement
 */
class UserAchievementQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserAchievement[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserAchievement|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
