<?php
/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/17
 * Time: 下午5:23
 */

namespace zacksleo\yii2\backend\tests;


use Swift_TransportException;
use zacksleo\yii2\backend\models\forms\PasswordResetRequestForm;
use yii;

class PasswordResetRequestFormTest extends TestCase
{
    public function testSendEmail()
    {
        $form = new PasswordResetRequestForm();
        $form->email = "zacksleo@gmail.com";
        try{
            $res = $form->sendEmail();
            $this->assertTrue($res);
        }catch (Swift_TransportException $e){
            return;
        }

    }
}