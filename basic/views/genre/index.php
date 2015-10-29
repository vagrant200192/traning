<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'TITLE_GENRES');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genre-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (User::isUserAdmin(Yii::$app->user->identity->email)): ?>
        <?= Html::a(Yii::t('app', 'BUTTON_CREATE_GENRE'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a($model->name, \yii\helpers\Url::to(['view', 'id' => $model->id]));
                }
            ],

        ],
    ]); ?>

</div>
