<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Penerbit */

$this->title = 'Update Penerbit : ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Penerbit', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penerbit-update">
	<div class="box box-primary">
		<div class="box-header with-border">

			<!-- <h1><?= Html::encode($this->title) ?></h1> -->

			<?= $this->render('_form', [
				'model' => $model,
			]) ?>

		</div>
	</div>
</div>
