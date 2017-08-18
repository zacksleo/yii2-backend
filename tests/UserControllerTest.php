<?php
/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/18
 * Time: 下午12:41
 */

namespace zacksleo\yii2\backend\tests;

use Yii;
use zacksleo\yii2\backend\models\Admin;

class UserControllerTest extends TestCase
{
    public $data;

    public function setUp()
    {
        parent::setUp();
        $user = Admin::findOne(1);
        Yii::$app->user->login($user);
        $time = time() . rand(1000, 9000);
        $this->data = [
            'User' => [
                'username' => 'username' . $time,
                'password_hash' => 'password1' . $time,
                'email' => $time . '@qq.com'
            ]
        ];
    }

    public function testCreare()
    {
        Yii::$app->request->bodyParams = $this->data;
        $res = Yii::$app->runAction('backend/user/create');
        $this->assertTrue($res->id > 0);
    }

    public function testView()
    {
        Yii::$app->request->bodyParams = $this->data;
        $model = Yii::$app->runAction('backend/user/create');
        $res = Yii::$app->runAction('backend/user/view', ['id' => $model->id]);
        $this->assertTrue($res->id > 0);
    }

    public function testUpdate()
    {
        Yii::$app->request->bodyParams = $this->data;
        $model = Yii::$app->runAction('backend/user/create');

        $this->data['User']['password_hash'] = "pass" . time();
        Yii::$app->request->bodyParams = $this->data;
        $res = Yii::$app->runAction('backend/user/update', ['id' => $model->id]);
        $this->assertTrue($res);
    }

    public function testDelete()
    {
        Yii::$app->request->bodyParams = $this->data;
        $model = Yii::$app->runAction('backend/user/create');
        $res = Yii::$app->runAction('backend/user/delete', ['id' => $model->id]);
        $this->assertTrue($res > 0);
    }
}