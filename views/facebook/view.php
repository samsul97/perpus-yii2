<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Facebook */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Facebooks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="facebook-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->no], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->no], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'no',
            'id',
            'name',
            'screenName',
        ],
    ]) ?>

</div>
