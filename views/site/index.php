<?php

/* @var $this yii\web\View */
/* @var $lessons \app\models\Lesson*/

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать! Готовы учиться?</h1>

        <p class="lead">Здесь вы сможете подобрать урок на любой вкус и цвет! Окунитесь в мир безграничных знаний!</p>
    </div>

    <div class="body-content">
        <table id="dtBasicExample" class="table table-hover table-striped table-borderless">
            <thead>
            <tr>
                <th class="th-sm">Название
                </th>
                <th class="th-sm">Краткое описание
                </th>
                <th class="th-sm">Просмотр
                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($lessons as $lesson) : ?>
            <tr>
                <td><?=$lesson->title?></td>
                <td><?=$lesson->short_description?></td>
                <td><?=$lesson->preview?></td>
            </tr>
           <?php endforeach; ?>
            </tfoot>
        </table>

    </div>
</div>
