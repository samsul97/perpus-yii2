<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PenerbitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penerbit';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penerbit-index">
    <div class="box box-primary">
        <div class="box-header with-border">    
    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box-body">
        
    </div>
    <p>
        <?= Html::a('Tambah Penerbit', ['create'], ['class' => 'btn btn-success btn-sm mt-3 mt-2']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['style' => 'text-align:center'],
                'contentOptions' => ['style' => 'text-align:center'],
                'header' => 'No'
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
