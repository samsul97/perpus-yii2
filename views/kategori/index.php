<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KategoriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategori';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-index">
    <div class="box box-primary">
        <div class="box-header with-border">

            <!-- <center><h2><?= Html::encode($this->title) ?></h2></center> -->
            <?php 
    // echo $this->render('_search', ['model' => $searchModel]); 
            ?>
        </div>
        <div class="box-body">

            <!-- <h1><?= Html::encode($this->title) ?></h1> -->
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <p>
                <?= Html::a('Tambah Kategori', ['create'], ['class' => 'btn btn-success btn-sm w-100 bt-2 bm-3']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'header' => 'No',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'contentOptions' => ['style' => 'text-align:center']
                    ],
                    'nama',
                    [
                        'header' => 'Jumlah Buku',
                        'value' => function ($model){
                            return $model->getjumlahBuku();
                        }
                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['style' => 'text-align:center,width:80px;']
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
