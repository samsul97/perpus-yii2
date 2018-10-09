<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Buku */

$this->title = 'Nama Buku : '.$model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Buku', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buku-view">
    <div class="box box-primary">
        <div class="box-header with-border">
            
    <!-- <h1><?= Html::encode($this->title) ?></h1> -->


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'nama',
            'tahun_terbit',
            'id_penulis',
            'id_penerbit',
            'id_kategori',
            'sinopsis:ntext',
            'sampul',
            'berkas',
        ],
    ]) ?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm w-100 mb-3 mt-2']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm w-100 mb-3 mt-2',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
        </div>
    </div>
</div>
