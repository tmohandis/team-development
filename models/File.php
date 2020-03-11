<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file".
 *
 * @property int $id
 * @property string $file_name
 * @property string $friendly_file_name
 *
 * @property LessonFile[] $lessonFiles
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_name', 'friendly_file_name'], 'required'],
            [['file_name'], 'string', 'max' => 255],
            [['friendly_file_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_name' => 'File Name',
            'friendly_file_name' => 'Friendly File Name',
        ];
    }

    /**
     * Gets query for [[LessonFiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLessonFiles()
    {
        return $this->hasMany(LessonFile::className(), ['file_id' => 'id']);
    }
}
