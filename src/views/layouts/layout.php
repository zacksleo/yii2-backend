<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use zacksleo\yii2\backend\widgets\Alert;
use zacksleo\yii2\backend\assets\AdminLteAsset;
use yii\web\View;

/* @var \yii\web\View $this */
/* @var string $content */

AdminLteAsset::register($this);
$menuList = \mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id);
$colors = ['red', 'yellow', 'aqua', 'blue', 'black', 'light-blue', 'green', 'grey', 'navy', 'olive', 'lime', 'orange', 'fuchsia', 'purple', 'maroon'];
$index = 0;
$roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
$role = array_keys($roles)[0];

$js = <<<JS
$('.sidebar-menu li.active').parent().parent().addClass('bg-success menu-open');
$('.sidebar-menu li.active').parent().attr('style',"display:block");
$('.sidebar-menu li.active').parent().prev().children('i').removeClass().addClass('fa fa-star text-white');
JS;

$this->registerJs($js, View::POS_END);
$css = <<<CSS
.sidebar-menu>li.bg-success>a{background-color: rgb(0, 166, 90) !important; color: rgb(255, 255, 255) !important;}
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
<body class="sidebar-mini skin-black">
<?php $this->beginBody() ?>
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?= Yii::$app->homeUrl; ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="/images/logo-light.png" style="height: 50px; padding: 5px 10px;" /></span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <img src="<?= Yii::$app->user->identity->getImageUrl(); ?>" class="user-image" alt="avatar">
              <span class="hidden-xs"><?= Yii::$app->user->identity->username; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= Yii::$app->user->identity->getImageUrl(); ?>" class="img-circle" alt="User Image">
                <p>
                  <?= Yii::$app->user->identity->username; ?> - <?= $role; ?>
                  <small>注册于 <?= date('Y-m-d', Yii::$app->user->identity->created_at) ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="<?= Url::to(['/backends/my/avatar']); ?>">头像</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="<?= Url::to(['/backends/my/change-password']); ?>">密码</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="<?= Url::to(['/backends/my/profile']); ?>">信息</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?= Url::to(['/backends/my/profile']); ?>" class="btn btn-default btn-flat">个人信息</a>
                </div>
                <div class="pull-right">
                  <a href="<?= Url::to(['/site/logout']); ?>" class="btn btn-default btn-flat">注销</a>
                </div>
              </li>
            </ul>
          </li>
          <li>
            <a href="/" target="_blank"><i class="fa fa-home"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= Yii::$app->user->identity->getImageUrl(); ?>" class="img-circle" alt="avatar">
        </div>
        <div class="pull-left info">
          <p><?= Yii::$app->user->identity->username; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?= $role; ?></a>
        </div>
      </div>
      <ul class="sidebar-menu tree" data-widget="tree">
        <?php foreach ($menuList as $menuCatalog) : ?>
        <li class="header"><?= $menuCatalog['label']; ?></li>
        <?php if (isset($menuCatalog['items'])) : ?>
            <?php foreach ($menuCatalog['items'] as $menuGroup) : ?>
            <li class="treeview">
          <a href="#">
            <i class="fa fa-star-o text-white"></i> <span><?= $menuGroup['label']; ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <?php if (isset($menuGroup['items'])) : ?>
          <ul class="treeview-menu">
            <?php foreach ($menuGroup['items'] as $key2 => $item) : ?>
            <li class="<?= Yii::$app->request->url == Url::to([$item['url'][0]]) ? 'active' : ''; ?>"><a href="<?= Url::to([$item['url'][0]]); ?>"><i class="fa fa-circle-o text-<?= $colors[$key2 % count($colors)]; ?>"></i> <?= $item['label'] ?></a></li>
          <?php endforeach; ?>
          </ul>
        <?php endif; ?>
        </li>
        <?php endforeach; ?>
        <?php endif; ?>
        <?php endforeach; ?>
    </ul>
    </section>
  </aside>

   <div class="content-wrapper" style="min-height: 901px;">
   <section class="content-header">
      <h1><?= $this->title; ?></h1>
      <?= Breadcrumbs::widget([
            'activeItemTemplate' => '<li>{link}</li>',
            'itemTemplate' => '<li>{link}</li>',
            'options' => [
                'class' => 'breadcrumb'
            ],
            'homeLink' => [
                'label' => '<i class="fa fa-dashboard"></i>仪表盘',
                'encode' => false,
                'url' => Yii::$app->homeUrl
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </section>
    <section class="content">
        <?= Alert::widget() ?>
        <div class="box">
        <div class="box-body">
            <?= $content; ?>
        </div>
        </div>
    </section>
   </div>

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
        <b>Version</b> <?= getenv('TAG'); ?>
        </div>
        <strong><?php echo Yii::t('app', 'copyright') ?></strong>
    </footer>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
