<?php

/* @var yii\web\View $this */
/* @var app\models\User $model */

use app\models\User;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>

<div class="row d-flex justify-content-center mt-3">
    <div class="col-md-8">
        <h4 class="mb-3">Основное</h4>

        <?php $form = ActiveForm::begin([
            'id' => 'form-signup',
            'options' => ['enctype' => 'multipart/form-data'],
            'layout' => 'horizontal',
        ]);
        ?>
        <div class="mb-3">
            <?= $form->field($model, 'username')->textInput()->label('Имя пользователя') ?>
        </div>
        <div class="mb-3">
            <?= $form->field($model, 'email')->textInput()->label('Email') ?>
        </div>
        <hr class="mb-4">
        <h4 class="mb-3">Контакты</h4>
        <div class="mb-3">
            <?= $form->field($model, 'phone')->textInput()->label('Мобильный телефон') ?>
        </div>
        <hr class="mb-4">
        <div class="mb-3">
            <?= $form->field($model, 'about')->textarea()->label('О себе') ?>
        </div>
        <hr class="mb-4">
        <div class="mb-3">
            <?= $form->field($model, 'avatar')->fileInput(['accept' => 'image/*'])
                ->label('Аватар' . Html::img($model->getThumbUploadUrl('avatar', User::AVATAR_PREVIEW))) ?>
        </div>
        <hr class="mb-4">

        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>