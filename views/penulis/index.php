<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PenulisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penulis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penulis-index">

    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="box-body">
                
            </div>

            <!-- <h1><?= Html::encode($this->title) ?></h1> -->
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Tambah Penulis', ['create'], ['class' => 'btn btn-success btn-sm w-100 mb-3 mt-2']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'header' => 'No',
                        'contentOptions' => ['style' =>'text-align:center'],
                        'headerOptions' => ['style' => 'text-align:center']
                    ],

            // 'id',
                    'nama',
                    'alamat:ntext',
                    'telepon',
                    'email:email',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['style' => 'text-align:center']
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
