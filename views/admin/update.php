<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\console\models\Admin */

$this->title = Yii::t('app', '更新管理员: ', [
        'modelClass' => 'Admin',
    ]) . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="admin-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
