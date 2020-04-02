<?php

/* @var $this yii\web\View */
/* @var $lessons \app\models\Lesson*/

$this->title = 'My Yii Application';
$lessons_chunked = array_chunk($lessons,3);
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

        <?php foreach ($lessons_chunked as $lessons) : ?>
                <div class="row d-flex justify-content-around flex-lg-nowrap">
        <?php foreach ($lessons as $lesson) : ?>
            <!-- Card Narrower -->
            <div class="card card-cascade narrower mr-lg-3">

                <!-- Card image -->
                <div class="view view-cascade overlay">
                    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Lightbox/Thumbnail/img%20(147).jpg"
                         alt="Card image cap">
                    <a>
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>

                <!-- Card content -->
                <div class="card-body card-body-cascade">

                    <!-- Label -->
                    <h5 class="pink-text pb-2 pt-1"><i class="fas fa-utensils"></i> Culinary</h5>
                    <!-- Title -->
                    <h4 class="font-weight-bold card-title"><?=$lesson->title?></h4>
                    <!-- Text -->
                    <p class="card-text"><?=$lesson->short_description?></p>
                    <!-- Button -->
                    <a class="btn btn-unique center-block">К уроку</a>

                </div>

            </div>
            <!-- Card Narrower -->
        <?php endforeach; ?>
        </div>
        <?php endforeach; ?>

    </div>
</div>
