<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use zacksleo\yii2\backend\Module;
use zacksleo\yii2\metronic\bundles\pages\Login4Asset;

/* @var \yii\web\Controller $this */
/* @var \yii\web\View $this */
/* @var yii\bootstrap\ActiveForm $form */
/* @var \app\models\forms\ResetPasswordForm $model */

$this->context->layout = '@vendor/zacksleo/yii2-backend/views/layouts/login4';
$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
Login4Asset::register($this);
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
        重置密码
    </h3>
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span> Enter any username and password. </span>
    </div>


    <?= $form->field($model, 'password', [
        'inputTemplate' => '<div class="form-group"><div class="input-icon"><i class="fa fa-lock"></i>{input}</div></div>',
    ])->input('password', [
        'class' => 'form-control placeholder-no-fix',
        'placeholder' => $model->getAttributeLabel('password'),
    ])->label('passwrod', [
        'class' => 'control-label visible-ie8 visible-ie9'
    ]); ?>

    <div class="form-actions">
        <button type="submit" class="btn green pull-right">提交</button>
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
<!--[if lt IE 9]>
<script src="../assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->