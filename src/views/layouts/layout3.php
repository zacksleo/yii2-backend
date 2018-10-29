<?php
use yii\helpers\Html;
use yii\helpers\Url;
use zacksleo\yii2\backend\widgets\Alert;
use yii\widgets\Breadcrumbs;
use zacksleo\yii2\backend\assets\AdminLteAsset;

/* @var \yii\web\View $this */
/* @var string $content */

AdminLteAsset::register($this);
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
    <body class="layout-top-nav skin-black">
    <?php $this->beginBody() ?>
    <div class="wrapper">
<header class="main-header">
  <nav class="navbar navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <a href="<?= Url::to(['site/index']) ?>" class="navbar-brand"><b>Admin</b>LTE</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
          <li><a href="#">Link</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a></li>
              <li class="divider"></li>
              <li><a href="#">One more separated link</a></li>
            </ul>
          </li>
        </ul>
        <form class="navbar-form navbar-left" role="search" _lpchecked="1">
          <div class="form-group">
            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
          </div>
        </form>
      </div>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <img src="/images/avatar.jpg" class="user-image" alt="avatar">
              <span class="hidden-xs">User</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="/images/avatar.jpg" class="img-circle" alt="avatar">
                <p>
                  User - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
<div class="content-wrapper" style="min-height: 202px;">
  <div class="container">
    <section class="content-header">
      <h1>
      <?= $this->title; ?>
      </h1>
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
      <div class="box box-default">
        <div class="box-body">
          <?= $content; ?>
        </div>
      </div>
    </section>
  </div>
</div>
<footer class="main-footer">
  <div class="container">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright © 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </div>
</footer>
</div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>