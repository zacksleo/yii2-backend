<?php

/* @var $this yii\web\View */
/* @var $model \zacksleo\yii2\backend\models\Admin */
/* @var $form ActiveForm */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->params['model'] = $model;
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->field($model, 'imageFile')->fileInput() ?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('app', '提交'), ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
