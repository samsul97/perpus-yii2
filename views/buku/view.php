<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Buku */

$this->title = 'Nama Buku : '.$model->nama;
// $this->params['breadcrumbs'][] = ['label' => 'Buku', 'url' => ['index']];
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
            [
                'label' => 'Nama (Tahun)',
                'attribute' => 'nama',
                'value' => $model->nama.  ' ('.$model->tahun_terbit.'),'
            ],
            [
                'attribute' => 'tahun_terbit',
                'value' => $model->tahun_terbit. ' MASEHI',
            ],


            [  
                        'attribute' => 'id_penulis',
                        'value' => function($data)
                        {
                            // Cara pemanggilan 1 yang ada di model buku.
                            //return $data->getPenulis();

                            // Cara pemanggilan 2 yang ada di model buku.
                            return $data->penulis->nama;
                        }
                    ],
                    // 'id_penerbit',
                    [  
                        'attribute' => 'id_penerbit',
                        'value' => function($data)
                        {
                            // Cara pemanggilan 1 yang ada di model buku.
                            //return $data->getPenerbit();

                            // Cara pemanggilan 2 yang ada di model buku.
                            return $data->penerbit->nama;
                        }
                    ],
                    // 'id_kategori',
                    [  
                        'attribute' => 'id_kategori',
                        'value' => function($data)
                        {
                            // Cara pemanggilan 1 yang ada di model buku.
                            //return $data->getKategori();

                            // Cara pemanggilan 2 yang ada di model buku.
                            return $data->kategori->nama;
                        }
                    ],
                    
            [
                'attribute' => 'sinopsis',
            ],
            [
                'label' => 'Sampul',
                'format' => ['image', ['width' => '100']],
                'value' => function ($model){
                    return ('@web/upload/sampul/'.$model->sampul);
                },
            ],

                // [
                // 'label' => 'Berkas',
                // 'format' => ['image', ['width' => '50']],
                // 'value' => function ($model){
                //     return ('@web/upload/berkas/'.$model->berkas);
                // },
                // ],

            [
                'attribute' => 'berkas',
                'format' => 'raw',
                'value' => function ($model)
                {
                    if ($model->berkas !== '') {
                        return '<a href="' . Yii::$app->request->baseUrl . '/upload/berkas/' . $model->berkas . '"><div align="left"><button class="btn btn-success glyphicon glyphicon-download-alt" type="submit"></button></div></a>';
                    }
                    else {
                        return '<div align="center"><h1>File tidak ada</h1></div>';
                    }
                },
            ],
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
