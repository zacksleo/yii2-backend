<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use zacksleo\yii2\backend\Module;
use zacksleo\yii2\backend\models\Admin;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\backend\models\Admin */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Module::t('backend', 'Admins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', '更新'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', '删除'), ['delete', 'id' => $model->id], [
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
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return Admin::getStatusList()[$model->status];
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
            'auth_key',
            'name',
        ],
    ]) ?>

</div>
