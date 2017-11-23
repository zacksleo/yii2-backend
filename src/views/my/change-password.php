<?php
/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\backend\models\forms\ChangePasswordForm */

/* @var $form ActiveForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use zacksleo\yii2\backend\models\Admin;

$this->params['model'] = Admin::findOne(Yii::$app->user->id);
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'old_password')->passwordInput(); ?>
<?= $form->field($model, 'new_password')->passwordInput(); ?>
<?= $form->field($model, 'new_password_repeat')->passwordInput(); ?>

    <div class="form-group">
        <?= Html::submitButton('提交', ['class' => 'btn green']) ?>
        <?= Html::resetButton('取消', ['class' => 'btn btn-default']); ?>
    </div>
<?php ActiveForm::end(); ?>