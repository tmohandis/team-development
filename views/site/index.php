<?php

/* @var $this yii\web\View */

/* @var $lessons app\models\Lesson[] */

use app\models\Lesson;
use yii\bootstrap4\Html;
use yii\widgets\Pjax;
use yii\bootstrap4\ActiveForm;
use app\models\Category;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать! Готовы учиться?</h1>

        <p class="lead">Здесь вы сможете подобрать урок на любой вкус и цвет! Окунитесь в мир безграничных знаний!</p>
        <button id="modalActivate" type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalPreview">
            Выберите интересующую вас категорию!
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade left" id="exampleModalPreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
        <div class="modal-dialog modal-full-height modal-left" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalPreviewLabel">Выберите категорию</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?php
                    echo \wbraganca\fancytree\FancytreeWidget::widget([
                        'options' => [
                            'source' =>  Category::findOne(1)->tree(),
                            'extensions' => ['glyph'],
                            'focusOnSelect' => true,
                            'activeVisible' => true,
                            'glyph' => [
                                'map' => [
                                    'folder' => 'fas fa-folder',
                                    'folderOpen' => 'fas fa-folder-open',
                                    'doc' => 'fas fa-book',
                                    'docOpen' => 'fas fa-file',
                                ],
                                'preset' => "awesome5",
                            ],
                            'activate' => new \yii\web\JsExpression('function(node, data) {
                              var a = document.getElementById("activeLink");
                              a.href = "/site/index?category=" + data.node.data.id;
                        }'),
                        ],
                    ]);
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <?= Html::a("Выбрать", ['site/index'], ['class' => 'btn btn-primary', 'id' => 'activeLink']) ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="body-content">
            <?php Pjax::begin([
                'linkSelector' => '#activeLink'
            ]); ?>
            <?php foreach (array_chunk($lessons, 3) as $threeLessons) : ?>
                <div class="row">
                    <?php foreach ($threeLessons as $lesson) : ?>
                        <div class="col-lg-4 col-md-12 mb-4">
                            <div class="card card-cascade narrower ">

                                <div class="view view-cascade overlay d-flex justify-content-center">
                                    <?= Html::img($lesson->getThumbUploadUrl('preview', Lesson::LESSON_PREVIEW), ['class' => 'img-fluid p-1']) ?>
                                </div>

                                <div class="card-body card-body-cascade">
                                    <h5 class="pink-text pb-2 pt-1"><?= Html::encode($lesson->category->name) ?></h5>
                                    <h4 class="font-weight-bold card-title"><?= Html::encode($lesson->title) ?></h4>
                                    <p class="card-text"><?= Html::encode($lesson->short_description) ?></p>

                                    <?= Html::a('К уроку', ['lesson/view', 'id' => $lesson->id], ['class' => 'btn btn-unique center-block text-white']) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            <?php Pjax::end(); ?>
    </div>
</div>
