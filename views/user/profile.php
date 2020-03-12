<?php

/* @var app\models\User $model */

use yii\bootstrap4\Html; ?>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/images/43.jpg" alt="Card image cap">
            <?= Html::a('Редактировать профиль', 'update', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card booking-card">
            <div class="card-body">
                <h4 class="card-title font-weight-bold"><a><?= Html::encode($model->username) ?></a></h4>
                <hr class="my-4">
                <p class="card-text"><?= Html::encode($model->about) ?></p>
            </div>
        </div>
    </div>
</div>
