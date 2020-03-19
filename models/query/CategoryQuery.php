<?php

namespace app\models\query;

use creocoder\nestedsets\NestedSetsQueryBehavior;

/**
 * This is the ActiveQuery class for [[\app\models\Category]].
 *
 * @see \app\models\Category
 */
class CategoryQuery extends \yii\db\ActiveQuery
{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }
    public function active()
    {
        return $this->andWhere('[[status]]=1');
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Category[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Category|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
