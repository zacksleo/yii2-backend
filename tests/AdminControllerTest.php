<?php
/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/15
 * Time: 下午5:21
 */

namespace zacksleo\yii2\backend\tests;

use yii\web\NotFoundHttpException;
use zacksleo\yii2\backend\models\Admin;
use yii;

class AdminControllerTest extends TestCase
{
    /**
     * @var \zacksleo\yii2\backend\tests\controllers\AdminController;
     */
    public $controller;

    public function setUp()
    {
        parent::setUp();
        $user = Admin::findOne(['id' => 1]);
        Yii::$app->user->login($user);
    }

    public function testIndex()
    {
        $res = Yii::$app->runAction('backend/admin/index');
        $this->assertTrue($res->getTotalCount() > 0);
    }

    public function testView()
    {
        $id = Yii::$app->user->id;
        $res = Yii::$app->runAction('backend/admin/view', ['id' => $id]);
        $this->assertTrue($res->email == 'zacksleo@gmail.com');
    }

    public function testCreate()
    {
        $data = [
            'Admin' => [
                'username' => 'username-test-create',
                'name' => 'name-test-create',
                'email' => time() . '@qq.com'
            ]
        ];
        Yii::$app->request->bodyParams = $data;
        try {
            $res = Yii::$app->runAction('backend/admin/create');
            $this->assertTrue($res->id > 0);
            $res = Yii::$app->runAction('backend/admin/delete', ['id' => $res->id]);
            $this->assertTrue($res > 0);
        } catch (NotFoundHttpException $e){
            var_dump($e->getMessage());
            return;
        }
    }

    public function testUpdate()
    {
        $data = [
            'Admin' => [
                'id' => 1,
                'username' => 'lianluo-1',
                'avatar' => yii\web\UploadedFile::getInstanceByName('imageFile')
            ]
        ];
        Yii::$app->request->bodyParams = $data;
        $res = Yii::$app->runAction('backend/admin/update', ['id' => 1]);
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