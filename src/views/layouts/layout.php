<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use zacksleo\yii2\backend\widgets\Alert;
use zacksleo\yii2\metronic\bundles\layouts\LayoutAsset;
use yii\web\View;

/* @var \yii\web\View $this */
/* @var string $content */

LayoutAsset::register($this);
$menuList = \mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id);
$js = <<<JS
$('.nav-item.active').parent().parent().addClass('active');
JS;
$this->registerJs($js, View::POS_END);
$css = <<<CSS
h1.page-title+div>h1{display:none}
CSS;
$this->registerCss($css);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="shortcut icon" href="/images/favicon.ico"/>
</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
<?php $this->beginBody() ?>
<div class="page-wrapper">

    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="<?= Yii::$app->homeUrl; ?>">
                    <img src="/images/logo-light.png" alt="logo" height="30" class="logo-default">
                </a>
                <div class="menu-toggler sidebar-toggler">
                    <span></span>
                </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
               data-target=".navbar-collapse">
                <span></span>
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <img alt="" class="img-circle" src="<?= Yii::$app->user->identity->avatar; ?>">
                            <span
                                class="username username-hide-on-mobile"> <?= Yii::$app->user->identity->username; ?> </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="<?= Url::to(['my/profile']); ?>">
                                    <i class="icon-user"></i> 个人信息 </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?= Url::to(['site/logout']); ?>">
                                    <i class="icon-key"></i> 注销 </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/" class="dropdown-toggle" target="_blank">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="page-container">
        <div class="page-sidebar-wrapper">
            <div class="page-sidebar navbar-collapse collapse">
                <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
                    data-slide-speed="200" style="padding-top: 20px">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <li class="sidebar-toggler-wrapper hide">
                        <div class="sidebar-toggler">
                            <span></span>
                        </div>
                    </li>
                    <?php foreach ($menuList as $menuCatalog): ?>
                        <li class="heading">
                            <h3 class="uppercase"><?= $menuCatalog['label']; ?></h3>
                        </li>
                        <?php if (isset($menuCatalog['items'])): ?>
                            <?php foreach ($menuCatalog['items'] as $menuGroup): ?>
                                <li class="nav-item open">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="icon-diamond"></i>
                                        <span class="title"><?= $menuGroup['label']; ?></span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu" style="display:block;">
                                        <?php if (isset($menuGroup['items'])): ?>
                                            <?php foreach ($menuGroup['items'] as $item): ?>
                                                <li class="nav-item <?php echo Yii::$app->request->url == Url::to([$item['url'][0]]) ? 'active' : ''; ?>">
                                                    <a href="<?= Url::to([$item['url'][0]]); ?>"
                                                       class="nav-link">
                                                        <span class="title"><?= $item['label'] ?></span>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                    <?= Breadcrumbs::widget([
                        'activeItemTemplate' => '<li><span>{link}</span></li>',
                        'itemTemplate' => '<li>{link}<i class="fa fa-circle"></i></li>',
                        'options' => [
                            'class' => 'page-breadcrumb'
                        ],
                        'homeLink' => [
                            'label' => '仪表盘',
                            'url' => Yii::$app->homeUrl
                        ],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                </div>
                <h1 class="page-title"> <?= $this->title; ?>
                </h1>
                <?= Alert::widget() ?>
                <?php echo $content; ?>
            </div>
        </div>
    </div>
    <div class="page-footer">
        <div class="page-footer-inner">
            <?php echo Yii::t('app', 'copyright'); ?>
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
