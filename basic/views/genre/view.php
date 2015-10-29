<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Genre */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'TITLE_GENRES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genre-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Yii::t('app', 'LIST_OF_BOOKS')?></p>
    <p>
        <?php if (User::isUserAdmin(Yii::$app->user->identity->email)): ?>
        <?= Html::a(Yii::t('app', 'BUTTON_UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'BUTTON_DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php endif?>
    </p>

    <?php foreach($model->books as $book){
        echo Html::tag('p', Html::a($book['title'], ['book/view' , 'id' => $book['id']]) );
    }   ?>

</div>
