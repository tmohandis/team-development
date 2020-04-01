<?php

namespace app\models\query;

use app\models\Lesson;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[LessonFile]].
 *
 * @see LessonFile
 */
class LessonFileQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Lesson[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Lesson|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
