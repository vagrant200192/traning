<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = Yii::t('app', 'TITLE_UPDATE_BOOK') . ': ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'TITLE_BOOKS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'TITLE_UPDATE');
?>
<div class="book-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'genres' => $genres,
    ]) ?>

</div>
