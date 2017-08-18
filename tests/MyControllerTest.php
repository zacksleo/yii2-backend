<?php
/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/16
 * Time: 上午11:15
 */

namespace zacksleo\yii2\backend\tests;

use yii;
use zacksleo\yii2\backend\models\Admin;

class MyControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $admin = Admin::findOne(1);
        Yii::$app->user->login($admin);
    }

    public function testAvatar()
    {
        $data = [
            'Admin' => [
                'imageFile' => yii\web\UploadedFile::getInstanceByName('imageFile')
            ]
        ];
        Yii::$app->request->bodyParams = $data;
        $res = Yii::$app->runAction('backend/my/avatar');
        $this->assertTrue($res);
    }

    public function testChangePassword()
    {
        $data = [
            'ChangePasswordForm' => [
                'old_password' => '1!an1u0',
                'new_password' => "111aaa",
                'new_password_repeat' => "111aaa"
            ]
        ];
        Yii::$app->request->bodyParams = $data;
        $res = Yii::$app->runAction('backend/my/changepassword');
        $this->assertTrue($res);

        $data = [
            'ChangePasswordForm' => [
                'old_password' => '111aaa',
                'new_password' => "1!an1u0",
                'new_password_repeat' => "1!an1u0"
            ]
        ];
        Yii::$app->request->bodyParams = $data;
        $res = Yii::$app->runAction('backend/my/changepassword');
        $this->assertTrue($res);
    }

    public function testProfile()
    {
        $data = [
            'Admin' => [
                'name' => 'lianluo-1'
            ]
        ];
        Yii::$app->request->bodyParams = $data;
        $res = Yii::$app->runAction('backend/my/profile');
        $this->assertTrue($res);

        $data['Admin']['name'] = 'lianluo';
        Yii::$app->request->bodyParams = $data;
        $res = Yii::$app->runAction('backend/my/profile');
        $this->assertTrue($res);
    }

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $_FILES = [
            'imageFile' => [
                'name' => 'test.jpg',
                'type' => 'image/jpeg',
                'size' => 74463,
                'tmp_name' => __DIR__ . '/web/test.jpg',
                'error' => 0,
            ],
        ];
    }
}
