<?php

namespace app\models;

use app\models\query\CategoryQuery;
use creocoder\nestedsets\NestedSetsBehavior;
use \wokster\treebehavior\NestedSetsTreeBehavior;
use Yii;


/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int $tree
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property string $category_name
 * @property string|null $short_description
 *
 * @property LessonCategory[] $lessonCategories
 */


class Category extends \yii\db\ActiveRecord
{
    public $parent_category;

    public function behaviors()
    {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                'treeAttribute' => 'tree',
            ],
            'htmlTree' => [
                'class' => NestedSetsTreeBehavior::className()
            ],
        ];
    }

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
            [['name'], 'required'],
            [['lft', 'rgt', 'depth'], 'integer'],
            [['tree', 'lft', 'rgt', 'depth'], 'safe'],
            [['parent_category', 'short_description', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tree' => 'Tree',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => 'Уровень категории',
            'short_description' => 'Краткое описание',
            'name' => 'Категория',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\CategoryQuery the active query used by this AR class.
     */

    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }
}
