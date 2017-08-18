<?php
/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/17
 * Time: 下午5:17
 */

namespace zacksleo\yii2\backend\tests;


use zacksleo\yii2\backend\models\forms\LoginForm;

class LoginFormTest extends TestCase
{
    public function testLogin()
    {
        $form = new LoginForm();
        $form->username = "lianluo";
        $form->password = "lianluo";
        $form->validate();
        $form->login();
        $this->assertFalse(empty($form->getErrors()));

        $form->username = "lianluo";
        $form->password = "1!an1u0";
        $form->rememberMe = true;
        $form->validate();
        $form->login();
        $this->assertTrue(empty($form->getErrors()));
        $res = $form->attributeLabels();
        $this->assertTrue(count($res) == 2);
   }
}
