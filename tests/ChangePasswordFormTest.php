<?php
/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/17
 * Time: 下午5:04
 */

namespace zacksleo\yii2\backend\tests;

use yii\base\InvalidParamException;
use zacksleo\yii2\backend\models\Admin;
use zacksleo\yii2\backend\models\forms\ChangePasswordForm;
use yii;

class ChangePasswordFormTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $admin = Admin::findOne(1);
        Yii::$app->user->login($admin);
    }

    public function testVerifyOldPassword()
    {
        $form = new ChangePasswordForm();
        $form->old_password = "1!an1u0";
        $form->new_password = "1ian1uo";
        $form->new_password_repeat = "1ian1uo1";
        $this->assertFalse($form->validate());

        $form->new_password_repeat = "1ian1uo";
        $this->assertTrue($form->validate());
        $form->verifyOldPassword('old_password', []);

        $form->validate();
        $this->assertTrue(empty($form->getErrors()));

        $form->old_password = "1ianlu0";
        $form->verifyOldPassword('old_password', []);
        $form->validate();
        $this->assertFalse(empty($form->getErrors()));

        Yii::$app->user->logout();
        try {
            $form = new ChangePasswordForm();
        } catch (InvalidParamException $e) {
            $this->assertTrue($e instanceof InvalidParamException);
        }
    }

    public function testResetPassword()
    {
        $form = new ChangePasswordForm();
        $form->new_password = "lianluo";
        $this->assertTrue($form->resetPassword());
        $form->new_password = "1!an1u0";
        $this->assertTrue($form->resetPassword());
    }
}
