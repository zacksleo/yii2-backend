<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use zacksleo\yii2\backend\Module;

/* @var \yii\web\Controller $this */
/* @var \yii\web\View $this */
/* @var \zacksleo\yii2\backend\models\forms\LoginForm $model */
/* @var \yii\bootstrap\ActiveForm */

$this->context->layout = '@vendor/zacksleo/yii2-backend/src/views/layouts/login4';
?>

<div class="login-box">
  <div class="login-logo">
    <a href="<?= Url::to(['default/index']); ?>"><?= Yii::$app->name; ?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><?php echo Module::t('backend', 'Login to your account'); ?></p>

    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'options' => [
            'class' => 'login-form'
        ]
    ]); ?>
      <?= $form->field($model, 'username', [
            'inputTemplate' => '<div class="form-group has-feedback">{input}<span class="glyphicon glyphicon-envelope form-control-feedback"></span></div>',
        ])->input('username', [
            'class' => 'form-control',
            'placeholder' => $model->getAttributeLabel('username')
        ])->label(false); ?>
      <?= $form->field($model, 'password', [
            'inputTemplate' => '<div class="form-group has-feedback">{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span></div>',
        ])->input('password', [
            'class' => 'form-control',
            'placeholder' => $model->getAttributeLabel('password')
        ])->label(false); ?>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="LoginForm[rememberMe]"> <?= Module::t('backend', 'Remember me') ?>
            </label>
          </div>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo Module::t('backend', 'Login') ?></button>
        </div>
      </div>
    <?php ActiveForm::end(); ?>
  </div>
</div>