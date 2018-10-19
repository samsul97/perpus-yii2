<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Anggota */

$this->title = 'Nama Anggota: '.$model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Anggota', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-view">




    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'nama',
            'alamat',
            'telepon',
            'email:email',
            [
                'attribute' => 'status_aktif',
                'value' => function ($model) {
                    if ($model->status_aktif == 1) {
                        return "Aktif";
                    } else {
                        return "Tidak";
                    }
                }
            ],
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
