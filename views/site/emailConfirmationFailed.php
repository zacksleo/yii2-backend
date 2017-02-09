<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\themes\metronic\assets\LoginAsset;

/* @var \yii\web\View $this */
/* @var \app\models\forms\LoginForm $model */
/* @var \yii\bootstrap\ActiveForm */

LoginAsset::register($this);
/* @var yii\web\View $this */
$this->title = '链接失效';
$this->params['breadcrumbs'][] = $this->title;
$params = Yii::$app->params;
?>
<div class="site-signup alert alert-danger">
    <h1>无法完成注册</h1>

    <p>您点击的确认链接无效或已过期,请使用邮箱联系我们: <?= Html::mailTo($params['support.name'], $params['support.email']) ?>.
    </p>

</div>
