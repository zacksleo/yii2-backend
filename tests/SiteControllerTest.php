<?php
/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/18
 * Time: 下午4:43
 */

namespace zacksleo\yii2\backend\tests;


use Swift_TransportException;
use zacksleo\yii2\backend\models\Admin;

class SiteControllerTest extends TestCase
{
    public function testLogin()
    {
        $data = [
            'LoginForm' => [
                'username' => 'lianluo',
                'password' => '1!an1u0'
            ]
        ];
        \Yii::$app->request->bodyParams = $data;
        $res = \Yii::$app->runAction('backend/site/login');
        $this->assertTrue($res);
    }

    public function testLogout()
    {
        $data = [
            'LoginForm' => [
                'username' => 'lianluo',
                'password' => '1!an1u0'
            ]
        ];
        \Yii::$app->request->bodyParams = $data;
        $res = \Yii::$app->runAction('backend/site/login');
        $this->assertTrue($res);

        $res = \Yii::$app->runAction('backend/site/logout');
        $this->assertTrue($res);
    }

    public function testRequestPasswordReset()
    {
        $data = [
            'PasswordResetRequestForm' => [
                'email' => '1546893095@qq.com'
            ]
        ];
        \Yii::$app->request->bodyParams = $data;
        try {
            $res = \Yii::$app->runAction('backend/site/requestpasswordreset');
            $this->assertFalse($res);
        } catch (Swift_TransportException $e) {
            return;
        }


        $data = [
            'PasswordResetRequestForm' => [
                'email' => 'zacksleo@gmail.com'
            ]
        ];
        \Yii::$app->request->bodyParams = $data;
        try {
            $res = \Yii::$app->runAction('backend/site/requestpasswordreset');
            $this->assertTrue($res);
        } catch (Swift_TransportException $e) {
            return;
        }
    }

    public function testResetPassword()
    {
        $model = Admin::findOne(1);
        $data = [
            'ResetPasswordForm' => [
                'password' => 'lianluo'
            ]
        ];
        \Yii::$app->request->bodyParams = $data;
        $res = \Yii::$app->runAction('backend/site/resetpassword', ['token' => $model->password_reset_token]);
        $this->assertTrue($res);

        $model = Admin::findOne(1);
        $data = [
            'ResetPasswordForm' => [
                'password' => '1!an1u0'
            ]
        ];
        $model->generatePasswordResetToken(true);
        \Yii::$app->request->bodyParams = $data;
        $res = \Yii::$app->runAction('backend/site/resetpassword', ['token' => $model->password_reset_token]);
        $this->assertTrue($res);
    }
}
