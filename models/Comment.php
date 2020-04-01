<?php

namespace app\models;

use app\models\query\CommentQuery;
use app\models\query\LessonCommentQuery;
use app\models\query\UserCommentQuery;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\behaviors\TimestampBehavior;
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
 * @property User[] $users
 * @property Lesson[] $lessons
 *
 * @mixin SaveRelationsBehavior
 */
class Comment extends ActiveRecord
{
    const RELATION_USER = 'users';
    const RELATION_LESSON = 'lessons';

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
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false,
            ],
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => [self::RELATION_USER, self::RELATION_LESSON],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment'], 'required'],
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
            'comment' => 'Комментарий'
        ];
    }

    public function getUsers()
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])->viaTable('user_comment', ['comment_id' => 'id']);
    }

    public function getLessons()
    {
        return $this->hasMany(Lesson::class, ['id' => 'lesson_id'])->viaTable('lesson_comment', ['comment_id' => 'id']);
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
