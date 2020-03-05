<?php

/* @var yii\web\View $this */
/* @var app\models\User $model */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/images/43.jpg" alt="Card image cap">
            <?= Html::a('Изменить фотографию', '#', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="col-md-8">
        <h4 class="mb-3">Основное</h4>

        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
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
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-block']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>