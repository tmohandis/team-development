<?php

namespace app\models\query;

use app\models\UserComment;

/**
 * This is the ActiveQuery class for [[\app\models\UserComment]].
 *
 * @see \app\models\UserComment
 */
class UserCommentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserComment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserComment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
