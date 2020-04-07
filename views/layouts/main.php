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
    <!--Navbar -->
    <nav class="mb-1 navbar navbar-expand-lg navbar-dark stylish-color lighten-1 fixed-top">
        <div class="container">
        <a class="navbar-brand" href="/site/index">GeekProject</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
                aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/site/index">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/site/about/">О нас</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/site/contact">Контакты</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <?php if (Yii::$app->user->isGuest): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/site/singup">Регистрация</a>
                    </li> <li class="nav-item">
                        <a class="nav-link" href="/site/login">Войти</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link waves-effect waves-light">1
                            <i class="fas fa-envelope"></i>
                        </a>
                    </li>
                    <li class="nav-item avatar dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <?= Html::img(Yii::$app->user->identity
                                ->getThumbUploadUrl('avatar', User::AVATAR_ICO), ['class' => 'img-fluid rounded-circle'])?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg-right dropdown-dark"
                             aria-labelledby="navbarDropdownMenuLink-55">
                            <a class="dropdown-item" href="/user/profile">Мой профиль</a>
                            <a class="dropdown-item" href="/lesson/index">Мои уроки</a>
                            <?=Html::a('Выйти',
                                ['site/logout'], [
                                    'class' => 'dropdown-item',
                                    'data' => [
                                        'method' => 'post',
                                    ],
                                ])?>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        </div>
    </nav>
    <!--/.Navbar -->
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>