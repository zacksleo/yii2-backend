<?php
/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/17
 * Time: 下午5:34
 */

namespace zacksleo\yii2\backend\tests;


use zacksleo\yii2\backend\models\Admin;
use zacksleo\yii2\backend\models\forms\ResetPasswordForm;

class ResetPasswordFormTest extends TestCase
{
    public function testResetPassword()
    {
        $model = Admin::findOne(['id' => 1]);
        $model->generatePasswordResetToken(true);
        $form = new ResetPasswordForm($model->getAttribute('password_reset_token'));
        $form->password = "lianluo";
        $form->validate();
        $this->assertTrue($form->resetPassword());
        $model->generatePasswordResetToken(true);
        $form->password = "1!an1u0";
        $form->validate();
        $this->assertTrue($form->resetPassword());
        $model->generatePasswordResetToken(true);

        try{
            $form = new ResetPasswordForm('');
        }catch (\yii\base\InvalidParamException $e){
            $this->assertTrue($e instanceof \yii\base\InvalidParamException);
        }
        try{
            $form = new ResetPasswordForm('zxcvbfd');
        }catch (\yii\base\InvalidParamException $e){
            $this->assertTrue($e instanceof \yii\base\InvalidParamException);
        }
    }
}
