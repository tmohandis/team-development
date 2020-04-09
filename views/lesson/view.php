<?php

use app\models\User;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

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
        <?= Html::img(
                $model->creator->getThumbUploadUrl('avatar', User::AVATAR_PREVIEW),
                ['class' => 'img-thumbnail rounded-circle', 'style' => 'width: 100px'])
        ?>
        <div class="d-flex flex-column justify-content-center ml-3">
            <h4><?= Html::encode($model->creator->username) ?></h4>
            <p><?= date("j F Y, G:i", $model->created_at) ?></p>
        </div>
    </div>

    <style>
        .main-container > p > img {
            max-width: 100%;
        }
    </style>
    <div class="main-container mb-5">
        <?= HtmlPurifier::process($model->description) ?>
    </div>
    <hr class="my-4">

    <div class="comments col-md-8">
        <h4>Комментарии</h4>
        <hr class="my-4">

        <div class="row">
            <div class="col-md-5">
                <?php foreach ($commentsUsers as $commentUser) : ?>
                    <div class="comment">
                        <div class="comment-user d-flex">
                            <?php $user = User::findOne($commentUser['userId']); ?>
                            <?= Html::img(
                                $user->getThumbUploadUrl('avatar', User::AVATAR_PREVIEW),
                                ['class' => 'img-thumbnail rounded-circle', 'style' => 'width: 75px'])
                            ?>
                            <div class="d-flex flex-column justify-content-center ml-3">
                                <h5><?= Html::encode($commentUser['username']) ?></h5>
                                <p class="text-muted"><?= date("j F Y, G:i", $commentUser['date']) ?></p>
                            </div>
                        </div>
                        <div class="comment-body ml-5 mt-1">
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


</div>
