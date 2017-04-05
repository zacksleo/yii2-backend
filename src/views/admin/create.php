<?php

use yii\helpers\Html;
use zacksleo\yii2\backend\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\console\models\Admin */

$this->title = Module::t('backend', 'Create Admin');
$this->params['breadcrumbs'][] = ['label' => Module::t('backend', 'Admins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
