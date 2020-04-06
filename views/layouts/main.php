
<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\models\Category;
use app\models\User;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Modal;
use app\assets\AppAsset;
use app\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php

    NavBar::begin([
        'brandLabel' => 'GeekProject',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-lg navbar-light bg-light fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Главная', 'url' => ['/site/index']],
        ['label' => 'О нас', 'url' => ['/site/about']],
        ['label' => 'Контакты', 'url' => ['/site/contact']],
    ];
    $menuItems[] ='<li class="nav-item">' .
        Html::a('Дерево категорий', ['#'], [
            'class' => 'nav-link',
            'data-target' => '#tree',
            'data-toggle' => 'modal',
        ])
    . '</li>';
    if (Yii::$app->user->id==1) {
        $menuItems[] = ['label' => 'Редактировать категории', 'url' => ['/category/index']];
    }
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Зарегистрироваться', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
    }else {
        $menuItems[] = ['label' => 'Мой профиль', 'url' => ['/user/profile']];
        $menuItems[] = ['label' => 'Мои уроки', 'url' => ['/lesson/index']];
        $menuItems[] = '<li class="nav-item">' .
            Html::a('Выйти (' . Yii::$app->user->identity->username . Html::img(Yii::$app->user->identity
                    ->getThumbUploadUrl('avatar', User::AVATAR_ICO), ['class' => 'img-fluid rounded-circle']) .')',
                ['site/logout'], [
                    'class' => 'nav-link',
                    'data' => [
                        'method' => 'post',
                    ],
                ])
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto flex-column-reverse flex-md-row'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?=Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<?php Modal::begin([
    'size' => 'modal-lg',
    'options' => [
            'id' => 'tree'
            ],
    'title' => 'Дерево категорий',
  ]);
?>
<style type="text/css">
    ul.fancytree-container {
        font-size: 18px;
        font-weight: 700;
        color: dodgerblue;
    }
</style>
<div class="row">
    <div class="col">
        <?php
        $data = Category::findOne(1)->tree();
        echo \wbraganca\fancytree\FancytreeWidget::widget([
            'options' =>[
                'source' => $data,
                'extensions' => ['glyph'],

                'focusOnSelect'=> true,
                'activeVisible'=> true,
                'glyph' => [
                    'map' => [
                        'folder'=> 'fas fa-folder',
                        'folderOpen'=> 'fas fa-folder-open',
                        'doc'=> 'fas fa-book',
                        'docOpen'=> 'fas fa-file',
                    ],
                    'preset'=> "awesome5",
                ],
                'activate' => new \yii\web\JsExpression('function(node, data) {
                              $("#cat-info .box-header>h3").text(data.node.title);
                              $("#cat-info .box-body").text(data.node.data.short_description);
                        }'),
            ],
        ]);
        ?>
    </div>
    <div class = "col">
        <div class = "box box-primary" id="cat-info">
            <div class = "box-header with-border">
                <h3 class = "box-title" style="text-align: center; color: #0b51c5"></h3>
                <div class = "box-body" style="font-size: 20px"> </div>
            </div>
        </div>
    </div>
</div>
<?php Modal::end(); ?>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>