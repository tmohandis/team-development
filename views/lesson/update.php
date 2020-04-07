<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Lesson */
/* @var $categoriesNames app\models\Category[] */

$this->title = 'Изменить урок';
?>
<div class="lesson-update mt-3">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
        'categoriesNames' => $categoriesNames
    ]) ?>

</div>
