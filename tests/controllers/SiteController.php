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

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render($this->_viewPath . 'index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $this->layout = 'page';
            Yii::$app->params['bodyClass'] = 'login';
            return $this->render($this->_viewPath . 'login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * User logout
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render($this->_viewPath . 'requestPasswordReset', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render($this->_viewPath . 'resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionEditor()
    {
        return $this->render($this->_viewPath . 'editor');
    }
}
