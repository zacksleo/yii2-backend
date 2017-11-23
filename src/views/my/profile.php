<?php
/* @var $this yii\web\View */
/* @var $model \zacksleo\yii2\backend\models\Admin */

/* @var $form ActiveForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->params['model'] = $model;

?>
<?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <label class="col-md-3 control-label">用户名</label>
        <div class="col-md-9">
            <p class="form-control-static"><?= $model->username; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">邮箱</label>
        <div class="col-md-9">
            <p class="form-control-static"><?= $model->email; ?></p>
        </div>
    </div>
    <div class="form-group clearfix">
    </div>
<?php ActiveForm::end(); ?>