<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\LessonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lessons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lesson-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Lesson', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'category_id',
            'title',
            'preview',
            'short_description:ntext',
            //'description:ntext',
            //'creator_id',
            //'created_at',
            //'updated_at',
            //'file_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
