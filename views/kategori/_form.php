<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Kategori */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kategori-form">


			<?php $form = ActiveForm::begin(); ?>

			<?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

			<div class="form-group">
				<?= Html::submitButton('Simpan', ['class' => 'btn btn-success btn-sm w-100 mt-2 mb-3']) ?>
			</div>

			<?php ActiveForm::end(); ?>

</div>
