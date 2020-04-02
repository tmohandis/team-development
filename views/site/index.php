<?php

/* @var $this yii\web\View */
/* @var $lessons app\models\Lesson[]*/

use yii\bootstrap4\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать! Готовы учиться?</h1>

        <p class="lead">Здесь вы сможете подобрать урок на любой вкус и цвет! Окунитесь в мир безграничных знаний!</p>
    </div>

    <div class="body-content">
        <?php foreach (array_chunk($lessons,3) as $threeLessons) : ?>
            <div class="row">

                <?php foreach ($threeLessons as $lesson) : ?>
                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="card card-cascade narrower ">

                            <div class="view view-cascade overlay">
                                <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Lightbox/Thumbnail/img%20(147).jpg"
                                     alt="Card image cap">
                            </div>

                            <div class="card-body card-body-cascade">
                                <h5 class="pink-text pb-2 pt-1"><?= Html::encode($lesson->category->name) ?></h5>
                                <h4 class="font-weight-bold card-title"><?= Html::encode($lesson->title) ?></h4>
                                <p class="card-text"><?= Html::encode($lesson->short_description) ?></p>

                                <?= Html::a('К уроку', ['view', 'id' => $lesson->id], ['class' => 'btn btn-unique center-block text-white']) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

    </div>
</div>
