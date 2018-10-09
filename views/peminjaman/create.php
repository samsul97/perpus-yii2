<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Peminjaman */

$this->title = 'Tambah Peminjaman';
$this->params['breadcrumbs'][] = ['label' => 'Peminjaman', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peminjaman-create">
	<div class="box box-primary">
		<div class="box-header with-border">
			

			<!-- <h1><?= Html::encode($this->title) ?></h1> -->

			<?= $this->render('_form', [
				'model' => $model,
			]) ?>

		</div>
	</div>
</div>
