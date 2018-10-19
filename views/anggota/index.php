<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnggotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Anggota';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-index">
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="box-body">
                
            </div>
            <!-- <h1><?= Html::encode($this->title) ?></h1> -->
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Tambah Anggota', ['create'], ['class' => 'btn btn-success btn-sm w-100 mt-2 mb-3']) ?>
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
                    'alamat',
                    'telepon',
                    'email:email',
            //'status_aktif',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['style' => 'text-align:center;width:80px']
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
