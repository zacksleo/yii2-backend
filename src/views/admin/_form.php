<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use zacksleo\yii2\backend\models\Admin;
use zacksleo\yii2\backend\Module;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\backend\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(Admin::getStatusList()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Module::t('backend', 'Create') : Module::t('backend', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
