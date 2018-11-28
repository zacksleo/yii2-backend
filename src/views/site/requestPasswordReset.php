<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use zacksleo\yii2\metronic\bundles\pages\Login4Asset;
use zacksleo\yii2\backend\Module;

/* @var \yii\web\Controller $this */
/* @var \yii\web\View $this */
/* @var \app\models\forms\PasswordResetRequestForm $model */
/* @var \yii\bootstrap\ActiveForm */

Login4Asset::register($this);
$this->context->layout = '@zacksleo/yii2/backend/views/layouts/login4';
$this->title = '找回密码';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- BEGIN LOGO -->
<div class="logo">
    <a href="<?= Url::to(['default/index']); ?>">
        <img src="/images/logo-big.png" alt=""/> </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form', 'class' => 'login-form']); ?>
    <h3>忘记密码 ?</h3>
    <p> 在下面输入你的邮箱来重置密码. </p>
    <?= $form->field($model, 'email', [
        'inputTemplate' => '<div class="form-group"><div class="input-icon"><i class="fa fa-envelope"></i>{input}</div></div>',
    ])->input('email', [
        'class' => 'form-control placeholder-no-fix',
        'placeholder' => $model->getAttributeLabel('email')
    ])->label('email', [
        'class' => 'control-label visible-ie8 visible-ie9'
    ]); ?>

    <div class="form-actions">
        <a href="<?= Url::to(['site/login']); ?>" id="back-btn"
           class="btn red btn-outline">
            <?php echo Module::t('backend', 'Back') ?></a>
        <?= Html::submitButton('发送', ['class' => 'btn green pull-right']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <!-- END FORGOT PASSWORD FORM -->
    <!-- BEGIN REGISTRATION FORM -->
    <!-- END REGISTRATION FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright"> <?php echo Module::t('backend', 'copyright') ?></div>
<!-- END COPYRIGHT -->
<!--[if lt IE 9]>
<script src="../assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->

<!-- END CORE PLUGINS -->