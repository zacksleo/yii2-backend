<?php
use yii\helpers\Html;
use yii\web\View;
use zacksleo\yii2\backend\widgets\Alert;
use zacksleo\yii2\backend\assets\AdminLteAsset;

/* @var \yii\web\View $this */
/* @var string $content */
$asset = AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <link rel="shortcut icon" href="favicon.ico"/>
    </head>
    <body class="hold-transition login-page">
    <?php $this->beginBody() ?>
    <?= Alert::widget() ?>
    <?php echo $content; ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>