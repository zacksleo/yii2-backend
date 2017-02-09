<?php
/* @var $this yii\web\View */
/* @var $model app\models\forms\ChangePasswordForm */
/* @var $form ActiveForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->params['model'] = \app\modules\console\models\Admin::findOne(Yii::$app->user->id);
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'old_password')->passwordInput(); ?>
<?= $form->field($model, 'new_password')->passwordInput(); ?>
<?= $form->field($model, 'new_password_repeat')->passwordInput(); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn green']) ?>
        <?= Html::resetButton(Yii::t('app', 'Cancel'), ['class' => 'btn btn-default']); ?>
    </div>
<?php ActiveForm::end(); ?>