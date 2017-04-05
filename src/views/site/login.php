<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use zacksleo\yii2\backend\Module;

/* @var \yii\web\Controller $this */
/* @var \yii\web\View $this */
/* @var \app\models\forms\LoginForm $model */
/* @var \yii\bootstrap\ActiveForm */

$this->context->layout = '@vendor/zacksleo/yii2-backend/src/views/layouts/login4';

?>

<!-- BEGIN LOGO -->
<div class="logo">
    <a href="<?= Url::to(['default/index']); ?>">
        <img src="/images/logo-big.png" alt=""/> </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'options' => [
            'class' => 'login-form'
        ]
    ]); ?>
    <h3 class="form-title">
        <?php echo Module::t('backend', 'Login to your account'); ?>
    </h3>
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span> Enter any username and password. </span>
    </div>
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
    ])->label('passwrod', [
        'class' => 'control-label visible-ie8 visible-ie9'
    ]); ?>

    <div class="form-actions">
        <label class="rememberme mt-checkbox mt-checkbox-outline">
            <input type="checkbox" name="r emember" value="1"/>
            <?php echo Module::t('backend', 'Remember me') ?>
            <span></span>
        </label>
        <button type="submit" class="btn green pull-right">
            <?php echo Module::t('backend', 'Login') ?> </button>
    </div>
    <div class="forget-password">
        <h4><?php echo Module::t('backend', 'Forgot your password') ?> ?</h4>
        <p><?php echo Module::t('backend', 'no worries, click {tag} here {tagEnd} to reset your password', [
                    'tag' => '<a href="' . Url::to(['site/request-password-reset']) . '">',
                    'tagEnd' => '</a>'
                ]
            ) ?> . </p>
    </div>
    <?php ActiveForm::end(); ?>
    <!-- END LOGIN FORM -->
    <!-- BEGIN REGISTRATION FORM -->
    <!-- END REGISTRATION FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright"> <?php echo Yii::t('app', 'copyright') ?></div>
<!-- END COPYRIGHT -->
<!-- END CORE PLUGINS -->