<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\User;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Books',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => Yii::t('app', 'NAV_HOME'), 'url' => ['/site/index']],
            ['label' => Yii::t('app', 'NAV_REGISTRATION'), 'url' => ['/user/create'], 'visible' => Yii::$app->user->isGuest],
            ['label' => 'Users',
                'url' => ['/user/index'],
                'visible' => Yii::$app->user->isGuest ? false : User::isUserAdmin(Yii::$app->user->identity->email)
            ],
            ['label' => 'Comments',
                'url' => ['/comment/index'],
                'visible' => Yii::$app->user->isGuest ? false : User::isUserAdmin(Yii::$app->user->identity->email)
            ],
            ['label' => Yii::t('app', 'NAV_LANG'), 'url' => ['/language/index'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => Yii::t('app', 'NAV_NEWS'), 'url' => ['/news/index'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => Yii::t('app', 'NAV_GENRE'), 'url' => ['/genre/index'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => Yii::t('app', 'NAV_BOOKS'), 'url' => ['/book/index'], 'visible' => !Yii::$app->user->isGuest],
            Yii::$app->user->isGuest ?
                ['label' => Yii::t('app', 'NAV_LOGIN'), 'url' => ['/site/login']] :
                [
                    'label' => Yii::t('app', 'NAV_LOGOUT'). '(' . Yii::$app->user->identity->email . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
