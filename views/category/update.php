<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $categoriesNames app\models\Category[] */

$this->title = 'Изменить категорию: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Категория', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="menu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categoriesNames' => $categoriesNames
    ]) ?>

</div>
