<?php

namespace app\models;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "lesson".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string $preview
 * @property string $short_description
 * @property string $description
 * @property int $creator_id
 * @property int $created_at
 * @property int|null $updated_at
 * @property int|null $file_id
 *
 * @property User $creator
 * @property LessonCategory[] $lessonCategories
 * @property LessonComment[] $lessonComments
 * @property LessonFile[] $lessonFiles
 * @property LessonUser[] $lessonUsers
 */
class Lesson extends \yii\db\ActiveRecord
{
    const RELATION_CREATOR_USER = 'creatorUser';

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'creator_id',
                'updatedByAttribute' => null
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lesson';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'file_id'], 'integer'],
            [['title', 'preview', 'short_description', 'description'], 'required'],
            [['short_description', 'description'], 'string'],
            [['title', 'preview'], 'string', 'max' => 255],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creator_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'title' => 'Название',
            'preview' => 'Preview',
            'short_description' => 'Краткое описание',
            'description' => 'Описание',
            'creator_id' => 'Creator ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'file_id' => 'File ID',
        ];
    }

    /**
     * Gets query for [[Creator]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\UserQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'creator_id']);
    }

    /**
     * Gets query for [[LessonCategories]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\LessonCategoryQuery
     */
    public function getLessonCategories()
    {
        return $this->hasMany(LessonCategory::className(), ['lesson_id' => 'id']);
    }

    /**
     * Gets query for [[LessonComments]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\LessonCommentQuery
     */
    public function getLessonComments()
    {
        return $this->hasMany(LessonComment::className(), ['lesson_id' => 'id']);
    }

    /**
     * Gets query for [[LessonFiles]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\LessonFileQuery
     */
    public function getLessonFiles()
    {
        return $this->hasMany(LessonFile::className(), ['lesson_id' => 'id']);
    }

    /**
     * Gets query for [[LessonUsers]].
     *
     * @return \yii\db\ActiveQuery|\app\models\queries\LessonUserQuery
     */
    public function getLessonUsers()
    {
        return $this->hasMany(LessonUser::className(), ['lesson_id' => 'id']);
    }

    public function getCreatorUser()
    {
        return $this->hasOne(User::class, ['creator_id' => 'id']);
    }

    /**
     * [['comment' => 'some comment', 'username' => 'user', 'date' => '122332321' ], ... ]
     */
    public function getCommentsUsersArray()
    {
        $commentsUsersArray = [];
        $lessonsComments = $this->getLessonComments()->all();
        foreach ($lessonsComments as $lessonComment) {
            $comment = Comment::findOne($lessonComment->comment_id);
            $commentsUsers = $comment->getUserComments()->all();
            foreach ($commentsUsers as $commentUser) {
                $user = User::findOne($commentUser->user_id);
                $commentsUsersArray[] = [
                    'comment' => $comment->comment,
                    'username' => $user->username,
                    'date' => $comment->created_at
                ];
            }
        }
        return $commentsUsersArray;
    }

    /**
     * {@inheritdoc}
     * @return \app\models\queries\LessonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\LessonQuery(get_called_class());
    }
}
