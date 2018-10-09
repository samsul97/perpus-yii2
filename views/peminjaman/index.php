<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Buku;
use app\models\Anggota;
use app\models\Peminjaman;
use app\models\User;    
/* @var $this yii\web\View */
/* @var $searchModel app\models\PeminjamanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Peminjaman';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Admin -->
<?php if (Yii::$app->user->identity->id_user_role == 1): ?>
<div class="peminjaman-index">
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="box-body">

            </div>

            <!-- <h1><?= Html::encode($this->title) ?></h1> -->
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php if (User::isAnggota()): ?>
                <?= Html::a('Tambah Peminjaman', ['create'], ['class' => 'btn btn-success btn-sm w-100 mt-2 mb-3']) ?>
            <?php endif ?>

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

            // 'id',
            // 'id_buku',
                    [
                        'attribute' => 'id_buku',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'format' => 'raw',
                        'filter' => Buku::getList(),
                        'contentOptions' => ['style' =>'text-align:center;'],
                        'value' => function ($data) {
                            return @$data->buku->nama;
                        }
                    ],
                    [
                        'attribute' => 'id_anggota',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'format' => 'raw',
                        'filter' => Anggota::getList(),
                        'contentOptions' => ['style' =>'text-align:center;'],
                        'value' => function ($data) {
                            return @$data->anggota->nama;
                        }
                    ],

                    // 'tanggal_pinjam',
                    [
                        'attribute' => 'tanggal_pinjam',
                        'format' => ['DateTime', 'php: Y / F / d-D'],
                        'label' => 'Tanggal Pinjam',
                        'encodeLabel' => false,
                        'headerOptions'=> ['style' => 'text-align:center; width:200px;'],
                        'contentOptions' => ['style' => 'text-align:center']
                    ],
                    [
                        'attribute' => 'tanggal_kembali',
                        'format' => 'date',
                        'label' => 'Tanggal Kembali',
                        'encodeLabel' => false,
                        'headerOptions'=> ['style' => 'text-align:center; width:200px;'],
                        'contentOptions' => ['style' => 'text-align:center']
                    ],

                    // if (User::isAdmin()) {
                    //     [
                    //         'class' => 'yii\grid\ActionColumn',
                    //         'contentOptions' => ['style' => 'text-align:center']
                    //     ]
                    // }
                    // else
                    // {
                    //     return true;
                    // };
                    // 'tanggal_kembali',
                    
                ],
            ]); ?>
        </div>
    </div>
</div>
<?php endif ?>

<!-- // Anggota -->
<?php if (Yii::$app->user->identity->id_user_role == 2): ?>

<div class="peminjaman-index">
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="box-body">

            </div>

            <!-- <h1><?= Html::encode($this->title) ?></h1> -->
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php if (User::isAnggota()): ?>
                <?= Html::a('Tambah Peminjaman', ['create'], ['class' => 'btn btn-success btn-sm w-100 mt-2 mb-3']) ?>
            <?php endif ?>

            <?php if (Yii::$app->user->identity->id_anggota): ?>

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

            // 'id',
            // 'id_buku',
                    [
                        'attribute' => 'id_buku',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'format' => 'raw',
                        'filter' => Buku::getList(),
                        'contentOptions' => ['style' =>'text-align:center;'],
                        'value' => function ($data) {
                            return @$data->buku->nama;
                        }
                    ],
                    [
                        'attribute' => 'id_anggota',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'format' => 'raw',
                        'filter' => Anggota::getList(),
                        'contentOptions' => ['style' =>'text-align:center;'],
                        'value' => function ($data) {
                            return @$data->anggota->nama;
                        }
                    ],

                    // 'tanggal_pinjam',
                    [
                        'attribute' => 'tanggal_pinjam',
                        'format' => ['DateTime', 'php: Y / F / d-D'],
                        'label' => 'Tanggal Pinjam',
                        'encodeLabel' => false,
                        'headerOptions'=> ['style' => 'text-align:center; width:200px;'],
                        'contentOptions' => ['style' => 'text-align:center']
                    ],
                    [
                        'attribute' => 'tanggal_kembali',
                        'format' => 'date',
                        'label' => 'Tanggal Kembali',
                        'encodeLabel' => false,
                        'headerOptions'=> ['style' => 'text-align:center; width:200px;'],
                        'contentOptions' => ['style' => 'text-align:center']
                    ],

                    // if (User::isAdmin()) {
                    //     [
                    //         'class' => 'yii\grid\ActionColumn',
                    //         'contentOptions' => ['style' => 'text-align:center']
                    //     ]
                    // }
                    // else
                    // {
                    //     return true;
                    // };
                    // 'tanggal_kembali',
                    
                ],
            ]); ?>
            <?php endif ?>
        </div>
    </div>
</div>
<?php endif ?>

<!-- Prtugas -->
<?php if (Yii::$app->user->identity->id_user_role == 3): ?>
<div class="peminjaman-index">
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="box-body">

            </div>

            <!-- <h1><?= Html::encode($this->title) ?></h1> -->
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php if (User::isAnggota()): ?>
                <?= Html::a('Tambah Peminjaman', ['create'], ['class' => 'btn btn-success btn-sm w-100 mt-2 mb-3']) ?>
            <?php endif ?>

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

            // 'id',
            // 'id_buku',
                    [
                        'attribute' => 'id_buku',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'format' => 'raw',
                        'filter' => Buku::getList(),
                        'contentOptions' => ['style' =>'text-align:center;'],
                        'value' => function ($data) {
                            return @$data->buku->nama;
                        }
                    ],
                    [
                        'attribute' => 'id_anggota',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'format' => 'raw',
                        'filter' => Anggota::getList(),
                        'contentOptions' => ['style' =>'text-align:center;'],
                        'value' => function ($data) {
                            return @$data->anggota->nama;
                        }
                    ],

                    // 'tanggal_pinjam',
                    [
                        'attribute' => 'tanggal_pinjam',
                        'format' => ['DateTime', 'php: Y / F / d-D'],
                        'label' => 'Tanggal Pinjam',
                        'encodeLabel' => false,
                        'headerOptions'=> ['style' => 'text-align:center; width:200px;'],
                        'contentOptions' => ['style' => 'text-align:center']
                    ],
                    [
                        'attribute' => 'tanggal_kembali',
                        'format' => 'date',
                        'label' => 'Tanggal Kembali',
                        'encodeLabel' => false,
                        'headerOptions'=> ['style' => 'text-align:center; width:200px;'],
                        'contentOptions' => ['style' => 'text-align:center']
                    ],

                    // if (User::isAdmin()) {
                    //     [
                    //         'class' => 'yii\grid\ActionColumn',
                    //         'contentOptions' => ['style' => 'text-align:center']
                    //     ]
                    // }
                    // else
                    // {
                    //     return true;
                    // };
                    // 'tanggal_kembali',
                    
                ],
            ]); ?>
        </div>
    </div>
</div>
<?php endif ?>