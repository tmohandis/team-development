<?php

namespace app\models;

use app\models\query\CommentQuery;
use app\models\query\UserCommentQuery;
use app\models\query\UserQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_comment".
 *
 * @property int $comment_id
 * @property int $user_id
 *
 * @property User $user
 * @property Comment $comment
 */
class UserComment extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment_id', 'user_id'], 'required'],
            [['comment_id', 'user_id'], 'integer'],
            [
                ['user_id'], 'exist', 'skipOnError' => true,
                'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']
            ],
            [
                ['comment_id'], 'exist', 'skipOnError' => true,
                'targetClass' => Comment::class, 'targetAttribute' => ['comment_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'comment_id' => 'Comment ID',
            'user_id' => 'User ID',
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
     * Gets query for [[Comment]].
     *
     * @return ActiveQuery|CommentQuery
     */
    public function getComment()
    {
        return $this->hasOne(Comment::class, ['id' => 'comment_id']);
    }

    /**
     * {@inheritdoc}
     * @return UserCommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserCommentQuery(get_called_class());
    }
}
