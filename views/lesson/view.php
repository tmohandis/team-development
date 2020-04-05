<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Lesson */
/* @var $comment app\models\Comment */
/* @var $commentsUsers */

$this->title = $model->title;
\yii\web\YiiAsset::register($this);
?>
<div class="lesson-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="user-card col-md-4 d-flex mb-5">
        <img src="https://mdbootstrap.com/img/Photos/Avatars/img(31).jpg" class="img-thumbnail rounded-circle"
             alt="Responsive image" style="width: 100px">
        <div class="d-flex flex-column justify-content-center ml-3">
            <h4><?= Html::encode($model->creator->username) ?></h4>
            <p><?= date("j F Y, G:i", $model->created_at) ?></p>
        </div>
    </div>

    <div class="main-container mb-5">
        <p><?= $model->description ?></p>
    </div>
    <hr class="my-4">

    <h4>Комментарии</h4>
    <hr class="my-4">

    <div class="row">
        <div class="comments col-md-5">
            <?php foreach ($commentsUsers as $commentUser) : ?>
                <div class="comment">
                    <div class="comment-username">
                        <h5><?= Html::encode($commentUser['username']) ?></h5>
                        <p class="text-muted"><?= date("j F Y, G:i", $commentUser['date']) ?></p>
                    </div>
                    <div class="comment-body">
                        <p class="card-text"><?= Html::encode($commentUser['comment']) ?></p>
                    </div>
                    <hr class="my-4">
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?php $form = ActiveForm::begin([
                'action' => "/comment/create?lessonId=$model->id",
            ]); ?>

            <?= $form->field($comment, 'comment')->textarea(['rows' => 2])->label('') ?>

            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
