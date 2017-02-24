<?php
use yii\helpers\Html;
use yii\web\View;
use common\widgets\Alert;
use zacksleo\yii2\metronic\bundles\pages\Login4Asset;

/* @var \yii\web\View $this */
/* @var string $content */
$asset = Login4Asset::register($this);
$directoryAsset = Yii::$app->assetManager->getPublishedUrl($asset->sourcePath);
$js = <<<JS
jQuery.backstretch([
    "{$directoryAsset}/pages/media/bg/1.jpg",
    "{$directoryAsset}/pages/media/bg/2.jpg",
    "{$directoryAsset}/pages/media/bg/3.jpg",
    "{$directoryAsset}/pages/media/bg/4.jpg"
    ], {
      fade: 1000,
      duration: 8000
    }
);
JS;

$this->registerJs($js, View::POS_END);
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
        <link rel="shortcut icon" href="favicon.ico"/>
    </head>
    <body class="login">
    <?php $this->beginBody() ?>
    <?= Alert::widget() ?>
    <?php echo $content; ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>