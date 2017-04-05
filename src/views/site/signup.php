<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use backend\themes\metronic\assets\LoginAsset;
use zacksleo\yii2\backend\Module;

/* @var \yii\web\Controller $this */
/* @var \yii\web\View $this */
/* @var \app\models\forms\LoginForm $model */
/* @var \yii\bootstrap\ActiveForm */

LoginAsset::register($this);
$this->context->layout = 'login4';
?>

<!-- BEGIN LOGO -->
<div class="logo">
    <a href="/">
        <img src="/images/logo-big.png" alt=""/>
    </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN REGISTRATION FORM -->
    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'options' => [
            'class' => 'login-form'
        ]
    ]); ?>
    <h3><?php echo Module::t('backend', 'Sign Up') ?></h3>
    <p><?php echo Module::t('backend', 'Enter your personal details below') ?>:</p>
    <?= $form->field($model, 'email', [
        'inputTemplate' => '<div class="form-group"><div class="input-icon"><i class="fa fa-envelope"></i>{input}</div></div>',
    ])->input('email', [
        'class' => 'form-control placeholder-no-fix',
        'placeholder' => $model->getAttributeLabel('email')
    ])->label('email', [
        'class' => 'control-label visible-ie8 visible-ie9'
    ]); ?>
    <?= $form->field($model, 'phone', [
        'inputTemplate' => '<div class="form-group"><div class="input-icon"><i class="fa fa-phone"></i>{input}</div></div>',
    ])->input('phone', [
        'class' => 'form-control placeholder-no-fix',
        'placeholder' => $model->getAttributeLabel('phone')
    ])->label('phone', [
        'class' => 'control-label visible-ie8 visible-ie9'
    ]); ?>
    <p> <?php echo Module::t('backend', 'Enter your account details below') ?>: </p>
    <?= $form->field($model, 'username', [
        'inputTemplate' => '<div class="form-group"><div class="input-icon"><i class="fa fa-user"></i>{input}</div></div>',
    ])->input('username', [
        'class' => 'form-control placeholder-no-fix',
        'placeholder' => $model->getAttributeLabel('username')
    ])->label('username', [
        'class' => 'control-label visible-ie8 visible-ie9'
    ]); ?>
    <?= $form->field($model, 'password', [
        'inputTemplate' => '<div class="form-group"><div class="input-icon"><i class="fa fa-lock"></i>{input}</div></div>',
    ])->input('password', [
        'class' => 'form-control placeholder-no-fix',
        'placeholder' => $model->getAttributeLabel('password'),
    ])->label('password', [
        'class' => 'control-label visible-ie8 visible-ie9'
    ]); ?>
    <div class="form-actions">
        <button type="submit" id="register-submit-btn pull-right"
                class="btn green pull-right"> <?php echo Module::t('backend', 'Sign Up'); ?> </button>
    </div>
    <div class="create-account">
        <p> <?php echo Module::t('backend', 'Already have a account') ?> ?&nbsp;
            <a href="<?php echo Url::to(['site/login']) ?>">
                <?php echo Module::t('backend', 'Login now') ?> </a>
        </p>
    </div>
    <?php ActiveForm::end(); ?>
    <!-- END REGISTRATION FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright"> <?php echo Yii::t('app', 'copyright') ?></div>
<!-- END COPYRIGHT -->
<!-- END CORE PLUGINS -->