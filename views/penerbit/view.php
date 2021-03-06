<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Penerbit */

$this->title = 'Nama Penerbit : '. $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Penerbits', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="penerbit-view">
    <div class="box box-primary">
        <div class="box-header with-border">

            <!-- <h1><?= Html::encode($this->title) ?></h1> -->


            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
            // 'id',
                    'nama',
                    'alamat:ntext',
                    'telepon',
                    'email:email',
                ],
            ]) ?>

            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm w-100 mt-2 mb-3']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-sm w-100 mt-2 mb-3',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>
</div>
