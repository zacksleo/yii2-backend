<?php

use yii\helpers\Html;
use yii\helpers\Url;

$model = $this->params['model'];
?>
<?php $this->beginContent('@vendor/zacksleo/yii2-backend/src/views/layouts/layout.php'); ?>

<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
        <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="<?= $model->getImageUrl(); ?>" alt="User profile picture">
            <h3 class="profile-username text-center"><?= $model->username; ?></h3>
            <p class="text-muted text-center"><?= $model->name; ?></p>
        </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="<?= $this->context->action->id == 'profile' ? 'active' : ''; ?>">
                <a href="<?= Url::to(['my/profile']); ?>">个人信息</a>
            </li>
            <li class="<?= $this->context->action->id == 'avatar' ? 'active' : ''; ?>">
                <a href="<?= Url::to(['my/avatar']); ?>">设置头像</a>
            </li>
            <li class="<?= $this->context->action->id == 'change-password' ? 'active' : ''; ?>">
                <a href="<?= Url::to(['my/change-password']); ?>">修改密码</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="activity">
                <?= $content; ?>
            </div>
        </div>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>
