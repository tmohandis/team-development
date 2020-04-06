<?php

namespace app\models;

use app\models\query\LessonCategoryQuery;
use app\models\query\LessonCommentQuery;
use app\models\query\LessonFileQuery;
use app\models\query\LessonQuery;
use app\models\query\LessonUserQuery;
use app\models\query\UserQuery;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use mohorev\file\UploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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
 * @property Category $category
 * @property LessonCategory[] $lessonCategories
 * @property LessonComment[] $lessonComments
 * @property LessonFile[] $lessonFiles
 * @property LessonUser[] $lessonUsers
 *
 * @property User[] $users
 * @property Category[] $categories
 * @property File[] $files
 *
 * @mixin UploadImageBehavior
 */
class Lesson extends ActiveRecord
{
    const LESSON_PREVIEW = 'avatarPreview';

    const SCENARIO_INSERT = 'insert';
    const SCENARIO_UPDATE = 'update';

    const RELATION_USER = 'users';
    const RELATION_CATEGORY = 'categories';
    const RELATION_FILE = 'files';

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'creator_id',
                'updatedByAttribute' => null
            ],
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => [
                    self::RELATION_USER,
                    self::RELATION_CATEGORY,
                    self::RELATION_FILE
                ],
            ],
            [
                'class' => UploadImageBehavior::class,
                //имя файла с аватаром
                'attribute' => 'preview',
                //сценарий загрузки
                'scenarios' => [self::SCENARIO_INSERT, self::SCENARIO_UPDATE],
                'placeholder' => '@webroot/upload/profile/defaultAvatar.jpg',
                //путь к месту загрузки аватара
                'path' => '@webroot/upload/user/{creator.id}/lessons/{id}',
                //url доступа к аватару
                'url' => Yii::$app->params['hosts.team'] .
                    Yii::getAlias('@web/upload/user/{creator.id}/lessons/{id}'),
                'thumbs' => [
                    self::LESSON_PREVIEW => ['width' => 320, 'height' => 220],
                ],
            ],
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
            [['category_id'], 'integer'],
            [['title', 'short_description','description'], 'required'],
            [['short_description', 'description'], 'string'],
            [['description'], 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process'],
            [['title'], 'string', 'min' => 5,'max' => 255],
            [['short_description', 'description'], 'string', 'min' => 10,'max' => 10000],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'id']],
            [['preview'], 'image', 'extensions' => 'jpg, jpeg, gif, png', 'on' => [self::SCENARIO_INSERT, self::SCENARIO_UPDATE]],
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
            'preview' => 'Предварительный просмотр',
            'short_description' => 'Краткое описание',
            'description' => 'Описание',
            'creator_id' => 'Creator ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'file_id' => 'File ID',
        ];
    }

    public function getUsers()
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])->viaTable('lesson_user', ['lesson_id' => 'id']);
    }

    public function getCategories()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])->viaTable('lesson_category', ['lesson_id' => 'id']);
    }

    public function getFiles()
    {
        return $this->hasMany(File::class, ['id' => 'file_id'])->viaTable('lesson_file', ['lesson_id' => 'id']);
    }

    /**
     * Gets query for [[Creator]].
     *
     * @return ActiveQuery|UserQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::class, ['id' => 'creator_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[LessonCategories]].
     *
     * @return ActiveQuery|LessonCategoryQuery
     */
    public function getLessonCategories()
    {
        return $this->hasMany(LessonCategory::class, ['lesson_id' => 'id']);
    }

    /**
     * Gets query for [[LessonComments]].
     *
     * @return ActiveQuery|LessonCommentQuery
     */
    public function getLessonComments()
    {
        return $this->hasMany(LessonComment::class, ['lesson_id' => 'id']);
    }

    /**
     * Gets query for [[LessonFiles]].
     *
     * @return ActiveQuery|LessonFileQuery
     */
    public function getLessonFiles()
    {
        return $this->hasMany(LessonFile::class, ['lesson_id' => 'id']);
    }

    /**
     * Gets query for [[LessonUsers]].
     *
     * @return ActiveQuery|LessonUserQuery
     */
    public function getLessonUsers()
    {
        return $this->hasMany(LessonUser::class, ['lesson_id' => 'id']);
    }

    public function getCreatorUser()
    {
        return $this->hasOne(User::class, ['creator_id' => 'id']);
    }

    /**
     * [['comment' => 'some comment', 'username' => 'user', 'userId' => 'id', 'date' => '122332321' ], ... ]
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
                    'userId' => $user->id,
                    'date' => $comment->created_at
                ];
            }
        }
        return $commentsUsersArray;
    }

    /**
     * {@inheritdoc}
     * @return LessonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LessonQuery(get_called_class());
    }
}
