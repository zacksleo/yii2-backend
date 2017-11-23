<?php

namespace zacksleo\yii2\backend\controllers;

use zacksleo\yii2\backend\models\forms\ChangePasswordForm;
use yii;
use zacksleo\yii2\backend\models\Admin;
use yii\web\Controller;
use yii\filters\AccessControl;

class MyController extends Controller
{
    public $layout = '@vendor/zacksleo/yii2-backend/src/views/my/layouts';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['profile', 'change-password', 'avatar'],
                        'roles' => ['@'],
                    ]
                ],
            ]
        ];
    }

    /**
     * 设置头像
     * @return string|yii\web\Response
     */
    public function actionAvatar()
    {
        $model = Admin::findOne(Yii::$app->user->id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '修改成功');
            return $this->redirect(['avatar']);
        } else {
            return $this->render('avatar', [
                'model' => $model
            ]);
        }
    }

    /**
     * 修改密码
     * @return string|yii\web\Response
     */
    public function actionChangePassword()
    {
        $model = new ChangePasswordForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', '修改成功');
            return $this->redirect(['change-password']);
        } else {
            return $this->render('change-password', [
                'model' => $model
            ]);
        }
    }

    /**
     * 设置个人信息
     * @return string|yii\web\Response
     */
    public function actionProfile()
    {
        $model = Admin::findOne(Yii::$app->user->id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '修改成功');
            return $this->redirect(['profile']);
        } else {
            return $this->render('profile', [
                'model' => $model
            ]);
        }
    }
}
