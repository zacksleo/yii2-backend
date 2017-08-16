<?php
/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/15
 * Time: 上午11:29
 */

error_reporting(-1);
define('YII_ENABLE_ERROR_HANDLER', false);
define('YII_DEBUG', true);
require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

Yii::setAlias('@migrate', dirname(__DIR__).'/tests/migration');
