<?php
use yii\helpers\Html;
use yii\helpers\Url;
use backend\widgets\Alert;
use backend\themes\metronic\assets\Layout3Asset;

/* @var \yii\web\View $this */
/* @var string $content */

Layout3Asset::register($this);
?>
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
    <body class="page-container-bg-solid page-md">
    <?php $this->beginBody() ?>
    <div class="page-wrapper">
        <div class="page-wrapper-row">
            <div class="page-wrapper-top">
                <!-- BEGIN HEADER -->
                <div class="page-header">
                    <!-- BEGIN HEADER TOP -->
                    <div class="page-header-top">
                        <div class="container">
                            <!-- BEGIN LOGO -->
                            <div class="page-logo">
                                <a href="index.html">
                                    <img src="/images/logo-big.png" alt="logo" class="logo-default"
                                         style="height:35px;">
                                </a>
                            </div>
                            <!-- END LOGO -->
                            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                            <a href="javascript:;" class="menu-toggler"></a>
                            <!-- END RESPONSIVE MENU TOGGLER -->
                            <!-- BEGIN TOP NAVIGATION MENU -->
                            <div class="top-menu">
                                <ul class="nav navbar-nav pull-right">
                                    <!-- BEGIN USER LOGIN DROPDOWN -->
                                    <li class="dropdown dropdown-user dropdown-dark">
                                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"
                                           data-hover="dropdown" data-close-others="true">
                                            <img alt="" class="img-circle"
                                                 src="/images/avatar9.jpg">
                                            <span class="username username-hide-mobile">Nick</span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-default">
                                            <li>
                                                <a href="<?= Url::to(['user/profile']); ?>">
                                                    <i class="icon-user"></i> 个人信息 </a>
                                            </li>
                                            <li>
                                                <a href="<?= Url::to(['user/change-password']); ?>">
                                                    <i class="icon-calendar"></i> 修改密码 </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="<?= Url::to(['site/logout']); ?>">
                                                    <i class="icon-key"></i> 注销 </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- END USER LOGIN DROPDOWN -->
                                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                                    <li class="dropdown dropdown-extended quick-sidebar-toggler">
                                        <span class="sr-only">Toggle Quick Sidebar</span>
                                        <i class="icon-logout"></i>
                                    </li>
                                    <!-- END QUICK SIDEBAR TOGGLER -->
                                </ul>
                            </div>
                            <!-- END TOP NAVIGATION MENU -->
                        </div>
                    </div>
                    <!-- END HEADER TOP -->
                    <!-- BEGIN HEADER MENU -->
                    <div class="page-header-menu">
                        <div class="container">
                            <div class="hor-menu  ">
                                <ul class="nav navbar-nav">
                                    <li class="menu-dropdown classic-menu-dropdown active">
                                        <a href="/"> 首页
                                            <span class="arrow"></span>
                                        </a>
                                    </li>
                                    <li class="menu-dropdown classic-menu-dropdown hidden">
                                        <a href="javascript:;"> Layouts
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="dropdown-menu pull-left">
                                            <li class=" ">
                                                <a href="layout_mega_menu_light.html" class="nav-link  "> Light Mega
                                                    Menu </a>
                                            </li>
                                            <li class=" ">
                                                <a href="layout_top_bar_light.html" class="nav-link  "> Light Top Bar
                                                    Dropdowns </a>
                                            </li>
                                            <li class=" ">
                                                <a href="layout_fluid_page.html" class="nav-link  "> Fluid Page </a>
                                            </li>
                                            <li class=" ">
                                                <a href="layout_top_bar_fixed.html" class="nav-link  "> Fixed Top
                                                    Bar </a>
                                            </li>
                                            <li class=" ">
                                                <a href="layout_mega_menu_fixed.html" class="nav-link  "> Fixed Mega
                                                    Menu </a>
                                            </li>
                                            <li class=" ">
                                                <a href="layout_disabled_menu.html" class="nav-link  "> Disabled Menu
                                                    Links </a>
                                            </li>
                                            <li class=" ">
                                                <a href="layout_blank_page.html" class="nav-link  "> Blank Page </a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </div>
                            <!-- END MEGA MENU -->
                        </div>
                    </div>
                    <!-- END HEADER MENU -->
                </div>
                <!-- END HEADER -->
            </div>
        </div>
        <div class="page-wrapper-row full-height">
            <div class="page-wrapper-middle">
                <!-- BEGIN CONTAINER -->
                <div class="page-container">
                    <!-- BEGIN CONTENT -->
                    <div class="page-content-wrapper">
                        <!-- BEGIN CONTENT BODY -->
                        <!-- BEGIN PAGE HEAD-->
                        <div class="page-head">
                            <div class="container">
                                <!-- BEGIN PAGE TITLE -->
                                <div class="page-title">
                                    <h1>首页
                                        <small></small>
                                    </h1>
                                </div>
                                <!-- END PAGE TITLE -->
                            </div>
                        </div>
                        <!-- END PAGE HEAD-->
                        <!-- BEGIN PAGE CONTENT BODY -->
                        <div class="page-content">
                            <div class="container">
                                <!-- BEGIN PAGE BREADCRUMBS -->
                                <ul class="page-breadcrumb breadcrumb">
                                    <li>
                                        <a href="/">首页</a>
                                        <i class="fa fa-circle"></i>
                                    </li>
                                    <li>
                                        <span>Dashboard</span>
                                    </li>
                                </ul>
                                <!-- END PAGE BREADCRUMBS -->
                                <!-- BEGIN PAGE CONTENT INNER -->
                                <div class="page-content-inner">
                                    <div class="mt-content-body">
                                        <?= Alert::widget() ?>
                                        <?php echo $content; ?>
                                    </div>
                                </div>
                                <!-- END PAGE CONTENT INNER -->
                            </div>
                        </div>
                        <!-- END PAGE CONTENT BODY -->
                        <!-- END CONTENT BODY -->
                    </div>
                    <!-- END CONTENT -->
                </div>
                <!-- END CONTAINER -->
            </div>
        </div>
        <div class="page-wrapper-row">
            <div class="page-wrapper-bottom">
                <!-- BEGIN FOOTER -->
                <!-- BEGIN PRE-FOOTER -->
                <div class="page-prefooter">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
                                <h2>关于我们</h2>
                                <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam dolore. </p>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
                                <h2>关注我们</h2>
                                <ul class="social-icons">
                                    <li>
                                        <a href="javascript:;" data-original-title="rss" class="rss"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" data-original-title="facebook" class="facebook"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" data-original-title="twitter" class="twitter"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" data-original-title="googleplus" class="googleplus"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" data-original-title="linkedin" class="linkedin"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" data-original-title="youtube" class="youtube"></a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" data-original-title="vimeo" class="vimeo"></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
                                <h2>联系我们</h2>
                                <address class="margin-bottom-40"> Phone: 010-65918368
                                    <br> Email:
                                    <a href="mailto:usercenter@lianluo.com">usercenter@lianluo.com</a>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PRE-FOOTER -->
                <!-- BEGIN INNER FOOTER -->
                <div class="page-footer">
                    <div class="container"> 2016 © lianluo.com &nbsp;|&nbsp;
                    </div>
                </div>
                <div class="scroll-to-top" style="display: none;">
                    <i class="icon-arrow-up"></i>
                </div>
                <!-- END INNER FOOTER -->
                <!-- END FOOTER -->
            </div>
        </div>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>