<?php
/**
 * @link http://www.lianluo.com/
 * @copyright Copyright (c) 2016 Lianluo
 * @author lijunwei@lianluo.com
 * @date 2016-09-26
 * @version 1.0
 */

namespace app\modules\console\tests\controllers;

use app\modules\console\models\forms\ChangePasswordForm;
use yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use zacksleo\yii2\backend\models\Admin;
use zacksleo\yii2\backend\models\forms\ChangePasswordForm;

class MyController extends Controller
{
    public $layout = '@app/modules/console/views/my/layouts';

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
                'denyCallback' => function ($rule, $action) {
                    return $this->redirect('/portal/default/login');
                }
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
        return $model->load(Yii::$app->request->post()) && $model->save();
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
