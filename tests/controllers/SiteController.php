<?php

namespace zacksleo\yii2\backend\tests\controllers;

use yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use zacksleo\yii2\backend\models\forms\LoginForm;
use zacksleo\yii2\backend\models\forms\PasswordResetRequestForm;
use zacksleo\yii2\backend\models\forms\ResetPasswordForm;

/**
 * Default controller for the `backend` module
 */
class SiteController extends Controller
{
    public $layout = '@vendor/zacksleo/yii2-backend/src/views/layouts/layout';
    public $_viewPath = '@vendor/zacksleo/yii2-backend/src/views/site/';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'logout'],
                        'roles' => ['@'],
                    ]
                ],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'view' => '@vendor/zacksleo/yii2-backend/src/views/site/error'
            ],
        ];
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        return $model->load(Yii::$app->request->post()) && $model->login();
    }

    /**
     * User logout
     */
    public function actionLogout()
    {
        return Yii::$app->user->logout();
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestpasswordreset()
    {
        $model = new PasswordResetRequestForm();
        return $model->load(Yii::$app->request->bodyParams) && $model->validate() && $model->sendEmail();
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetpassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        $model->load(Yii::$app->request->bodyParams);
        return $model->load(Yii::$app->request->bodyParams) && $model->validate() && $model->resetPassword();
    }
}
