<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'TITLE_NEWS');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (User::isUserAdmin(Yii::$app->user->identity->email)): ?>
        <?= Html::a(Yii::t('app', 'BUTTON_CREATE_NEWS'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif?>
    </p>

    <?= \yii\widgets\ListView::widget([
         'dataProvider' => $dataProvider,
         'itemView' => function ($model, $key, $index, $widget){
             return $this->render('_item', ['model' => $model]);
         },
    ]) ?>

</div>
