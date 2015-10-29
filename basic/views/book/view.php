<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'TITLE_BOOKS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'cover',
                'value' => $model->cover,
                'format' => ['image', ['class' => 'book-img-view']],
            ],
            'title',
            'about:ntext',
            'publish_date',
            'author',
            [
                'label'=> Yii::t('app', 'ATTR_GENRE'),
                'value' => $model->getStringGenresName(),
            ]
        ],
    ]) ?>

    <p><?= Yii::t('app', 'LEAVE_COMMENT') ?>:</p>
    <?= $this->render('/comment/_form.php', [
        'model' => $comment,
    ]) ?>

    <?php echo $this->render('_comment', [
        'comments' => $model->getComments()->all(),
    ]) ?>

</div>
