<?php
/**
 * @link http://www.lianluo.com/
 * @copyright Copyright (c) 2016 Lianluo
 * @author lijunwei@lianluo.com
 * @date 2016-09-26
 * @version 1.0
 */

namespace zacksleo\yii2\backend\tests\controllers;

use yii;
use yii\web\Controller;
use zacksleo\yii2\backend\models\Admin;
use zacksleo\yii2\backend\models\forms\ChangePasswordForm;

class MyController extends Controller
{
    /**
     * 设置头像
     * @return string|yii\web\Response
     */
    public function actionAvatar()
    {
        $model = Admin::findOne(Yii::$app->user->id);
        return $model->load(Yii::$app->request->bodyParams) && $model->upload() &&$model->save();
    }

    /**
     * 修改密码
     * @return string|yii\web\Response
     */
    public function actionChangepassword()
    {
        $model = new ChangePasswordForm();
        return $model->load(Yii::$app->request->bodyParams) && $model->validate() && $model->resetPassword();
    }

    /**
     * 设置个人信息
     * @return string|yii\web\Response
     */
    public function actionProfile()
    {
        $model = Admin::findOne(Yii::$app->user->id);
        return $model->load(Yii::$app->request->bodyParams) && $model->save();
    }
}
