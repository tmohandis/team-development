<?php

use app\models\Lesson;
use vova07\imperavi\bundles\ImageManagerAsset;
use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Lesson */
/* @var $form yii\widgets\ActiveForm */
/* @var $categotiesNames app\models\Category[] */
?>

<div class="lesson-form mt-3">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'layout' => 'horizontal',
    ]);
    ?>

    <?= $form->field($model, 'category_id')->label('Категория')->dropDownList($categoriesNames)?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_description')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'preview')->fileInput(['accept' => 'image/*'])
        ->label('Превью' . Html::img($model->getThumbUploadUrl('preview', Lesson::LESSON_PREVIEW), ['class' => 'ml-5 mt-1'])) ?>

    <?= $form->field($model, 'description')->label('')->widget(Widget::class, [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'imageManagerJson' => Url::to(['/lesson/images-get', 'id' => $model->id]),
            'imageUpload' => Url::to(['/lesson/image-upload', 'id' => $model->id]),
            'imageDelete' => Url::to(['/lesson/file-delete', 'id' => $model->id]),
            'plugins' => [
                'fullscreen',
                'fontcolor',
                'fontfamily',
                'fontsize',
                'table',
            ],
        ],
        'plugins' => [
            'imagemanager' => ImageManagerAsset::class,
        ],
    ])?>
    <hr class="mb-4">

    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block']) ?>
    <?php ActiveForm::end(); ?>
</div>
