<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Kategori;
use app\models\Penerbit;
use app\models\Penulis;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BukuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Buku';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buku-index">
    <div class="box box-primary">
        <div class="box-header with-border">

            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            <!-- <center><h2><?= Html::encode($this->title) ?></h2></center> -->
            <?php 
    // echo $this->render('_search', ['model' => $searchModel]); 
            ?>
        </div>
        <div class="box-body">

            <!-- <br> -->
            <p>
                <?= Html::a( '<i class="fa fa-plus"></i> Tambah Buku', ['create'], ['class' => 'btn btn-info btn-sm w-100 mt-2 mb-3']) ?>
                <?= Html::a('Export Excel <i class="fa fa-file-excel-o"></i>', ['buku/export-excel'], ['class' => 'btn btn-success btn-sm w-100 mt-2 mb-3']) ?>
                <?= Html::a('Export Word <i class="fa fa-file-word-o"></i>', ['buku/export-word'], ['class' => 'btn btn-default btn-sm w-100 mt-2 mb-3']) ?>
                <?= Html::a('Export Pdf <i class="fa fa-file-pdf-o"></i>', ['buku/export-pdf'], ['class' => 'btn btn-danger btn-sm w-100 mt-2 mb-3']) ?>
                <?= Html::a('Export Word <i class="fa fa-file-pdf-o"></i>', ['buku/export-word2'], ['class' => 'btn btn-danger btn-sm w-100 mt-2 mb-3']) ?>
                <?= Html::a('Export PDF Surat <i class="fa fa-file-pdf-o"></i>', ['buku/pdf'], ['class' => 'btn btn-danger btn-sm w-100 mt-2 mb-3']) ?>
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
                        'attribute' => 'tahun_terbit',
                        'label' => 'Tahun Terbit',
                        'encodeLabel' => false,
                        'headerOptions' => ['style' => 'text-align:center','width' => '80'],
                        'contentOptions' => ['style' => 'text-align:center']
                    ],


            // fungsi ini yaitu untuk mengubah property id_kategori menjadi nama.fungsi ini terdapat di model buku dengan fungsi get kategori dan getlist.
                    [
                        'attribute' => 'id_kategori',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'format' => 'raw',
                        'filter' => Kategori::getList(),
                        'contentOptions' => ['style' =>'text-align:center;'],
                        'value' => function ($data) {
                            return @$data->kategori->nama;
                        }
                    ],
                    [
                        'attribute' => 'id_penerbit',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'filter' => Penerbit::getList(),
                        'contentOptions' => ['style' =>'text-align:center;'],
                        'value' => function ($data) {
                            return @$data->penerbit->nama;
                        }
                    ],
                    [
                        'attribute' => 'id_penulis',
                        'format' => 'raw',
                        'headerOptions' => ['style' => 'text-align:center'],
                        'filter' => Penulis::getList(),
                        'contentOptions' => ['style' =>'text-align:center;'],
                        'value' => function ($data) {
                            return @$data->penulis->nama;
                        }
                    ],
            // 'id_penulis',
            // 'id_penerbit',
            //'id_kategori',
            //'sinopsis:ntext',
            //'sampul',
            //'berkas',
                    [
                        'attribute' => 'sampul',
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'text-align:center'],
                        'headerOptions' => ['style' => 'text-align:center', 'width' => '20'],
                        'value' => function ($model)
                        {
                            if ($model->sampul !== '') {
                                return Html::img('@web/upload/sampul/' . $model->sampul, ['style'=>'height:80px', 'width:100px;']);
                            }
                            else{
                                return '<div align="center"><h1>File tidak ada</h1></div>';
                            }
                        },   
                    ],

                    [
                        'attribute' => 'berkas',
                        'format' => 'raw',
                        'contentOptions' => ['style' => 'text-align:center; width:80px'],
                        'headerOptions' => ['style' => 'text-align:center', 'width' => '20'],
                        'value' => function ($model)
                        {
                            if ($model->berkas !== '') {
                                return '<a href="' . yii::$app->request->baseUrl.'/upload/berkas/' . $model->berkas .'"><div align="center"><button class="btn btn-success glyphicon glyphicon-download-alt" type="submit"></button></div></a>';
                            }
                            else{
                                return '<div align="center"><h1>File tidak ada</h1></div>';
                            }
                        },
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['style' => 'text-align:center;width:80px']
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>