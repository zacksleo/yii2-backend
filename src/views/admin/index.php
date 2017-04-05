<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use zacksleo\yii2\backend\Module;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('backend', 'Admins');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">

    <p>
        <?= Html::a(Module::t('backend', 'Create Admin'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'avatar',
            'username',
            'email:email',
            // 'status',
            // 'create_time:datetime',
            // 'update_time:datetime',
            // 'auth_key',
            'name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
