<?php

namespace app\models;

use app\models\query\CategoryQuery;
use app\models\query\LessonCategoryQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string|null $parent_category_name
 * @property string $category_name
 *
 * @property LessonCategory[] $lessonCategories
 */
class Category extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_name'], 'required'],
            [['parent_category_name', 'category_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_category_name' => 'Parent Category Name',
            'category_name' => 'Category Name',
        ];
    }

    /**
     * Gets query for [[LessonCategories]].
     *
     * @return ActiveQuery|LessonCategoryQuery
     */
    public function getLessonCategories()
    {
        return $this->hasMany(LessonCategory::class, ['category_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }
}
