<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\widgets\WLang;
use app\models\User;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'TITLE_LANGUAGES');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="language-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (User::isUserAdmin(Yii::$app->user->identity->email)): ?>
    <p>
        <?= Html::a('Create Language', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'url:url',
            'local',
            'name',
            'default',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php endif?>

    <?= WLang::widget();?>
</div>
