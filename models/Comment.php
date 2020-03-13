<?php

namespace app\models;

use app\models\query\CommentQuery;
use app\models\query\LessonCommentQuery;
use app\models\query\UserCommentQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property string $comment
 * @property int $created_at
 *
 * @property LessonComment[] $lessonComments
 * @property UserComment[] $userComments
 */
class Comment extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment', 'created_at'], 'required'],
            [['comment'], 'string', 'min' => 5, 'max' => 1000],
            [['created_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment' => 'Comment',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[LessonComments]].
     *
     * @return ActiveQuery|LessonCommentQuery
     */
    public function getLessonComments()
    {
        return $this->hasMany(LessonComment::class, ['comment_id' => 'id']);
    }

    /**
     * Gets query for [[UserComments]].
     *
     * @return ActiveQuery|UserCommentQuery
     */
    public function getUserComments()
    {
        return $this->hasMany(UserComment::class, ['comment_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return CommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommentQuery(get_called_class());
    }
}
