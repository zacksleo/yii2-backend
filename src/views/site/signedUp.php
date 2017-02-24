<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

use backend\themes\metronic\assets\LoginAsset;


/* @var \yii\web\Controller $this */
/* @var \yii\web\View $this */
/* @var \app\models\forms\LoginForm $model */
/* @var \yii\bootstrap\ActiveForm */

LoginAsset::register($this);
/* @var yii\web\View $this */

$this->title = 'Signup';
?>
<div class="site-signup alert alert-info">
    <h1>感谢注册</h1>

    <p>我们已经向您的邮箱发送的确认链接,请检查您的邮箱.</p>

</div>
