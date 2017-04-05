<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use zacksleo\yii2\backend\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\console\models\Admin */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Module::t('backend', 'Admins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Module::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'avatar',
            'username',
            'email:email',
            'password',
            'status',
            'create_time:datetime',
            'update_time:datetime',
            'auth_key',
            'name',
        ],
    ]) ?>

</div>
