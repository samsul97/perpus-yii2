<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Registrasi;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign Up';

$fieldOptions1 = [
 'options' => ['class' => 'form-group has-feedback'],
 'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];

$fieldOptions2 = [
 'options' => ['class' => 'form-group has-feedback'],
 'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
$fieldOptions3 = [
 'options' => ['class' => 'form-group has-feedback'],
 'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions4 = [
 'options' => ['class' => 'form-group has-feedback'],
 'inputTemplate' => "{input}<span class='glyphicon glyphicon-phone form-control-feedback'></span>"
];

$fieldOptions5 = [
 'options' => ['class' => 'form-group has-feedback'],
 'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];

$fieldOptions6 = [
 'options' => ['class' => 'form-group has-feedback'],
 'inputTemplate' => "{input}<span class='glyphicon glyphicon-home form-control-feedback'></span>"
];
?>

<div class="login-box">
 <div class="login-logo">
   <a href="#"><b>Perpus</b>JJ</a>

 </div>
 <!-- /.login-logo -->
 <div class="login-box-body">
   <p class="login-box-msg">Daftar akun perpustakaan anda</p>

   <?php $form = ActiveForm::begin(['id' => 'Registrasi', 'enableClientValidation' => false]); ?>

   <?= $form
   ->field($model, 'username', $fieldOptions1)
   ->label(false)
   ->textInput(['placeholder' => 'username']) ?>

   <?= $form
   ->field($model, 'email', $fieldOptions3)
   ->label(false)
   ->textInput(['placeholder' => 'email']) ?>

   <?= $form
   ->field($model, 'nama', $fieldOptions5)
   ->label(false)
   ->textInput(['placeholder' => 'nama']) ?>
   
   <?= $form
   ->field($model, 'password', $fieldOptions2)
   ->label(false)
   ->passwordInput(['placeholder' => 'password']) ?>

   <?= $form
   ->field($model, 'alamat', $fieldOptions6)
   ->label(false)
   ->textInput(['placeholder' => 'alamat']) ?>

   <?= $form
   ->field($model, 'telepon', $fieldOptions4)
   ->label(false)
   ->textInput(['placeholder' => 'telepon']) ?>

   <?= $form->field($model, 'verifyCode')->widget(Captcha::className()) ?>
   

   <div class="row">
    <!-- /.col -->
    <div class="col-xs-12">
      <div class="col-xs-6">
        <button type="button" class="btn btn-default btn-block btn-flat" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>
      </div>
      <div class="col-xs-6">
        <?= Html::submitButton('Daftar', ['class' => 'btn btn-block btn-sosial btn-danger btn-flat', 'name' => 'login-button']) ?>
      </div>
    </div>
    <!-- /.col -->
  </div>


  <?php ActiveForm::end(); ?>

  <div class="social-auth-links text-center">
   <p>- OR -</p>
   <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in
   using Facebook</a>
   <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign
   in using Google+</a>
 </div>
 <!-- /.social-auth-links -->
</div>
<!-- /.login-box-body -->
</div><!-- /.login-box -->