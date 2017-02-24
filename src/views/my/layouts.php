<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\themes\metronic\assets\ProfileAsset;

$model = $this->params['model'];
ProfileAsset::register($this);
?>
<?php $this->beginContent('@app/themes/metronic/views/layouts/layout.php'); ?>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet bordered">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="<?= $model->avatar; ?>" class="img-responsive" alt=""></div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> <?= $model->username; ?></div>
                    <div class="profile-usertitle-job"> <?= $model->name; ?></div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
            </div>
            <!-- END PORTLET MAIN -->
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">账号信息</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="<?= $this->context->action->id == 'profile' ? 'active' : ''; ?>">
                                    <a href="<?= Url::to(['my/profile']); ?>">个人信息</a>
                                </li>
                                <li class="<?= $this->context->action->id == 'avatar' ? 'active' : ''; ?>">
                                    <a href="<?= Url::to(['my/avatar']); ?>">设置头像</a>
                                </li>
                                <li class="<?= $this->context->action->id == 'password' ? 'active' : ''; ?>">
                                    <a href="<?= Url::to(['my/change-password']); ?>">修改密码</a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane active" id="tab_1_1">
                                    <?= $content; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>
<?php $this->endContent(); ?>
