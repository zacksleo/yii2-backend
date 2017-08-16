<?php
/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/15
 * Time: 下午3:12
 */

namespace zacksleo\yii2\backend\tests;


use yii;
use yii\web\UploadedFile;
use zacksleo\yii2\backend\models\Admin;

class AdminModelTest extends TestCase
{
    /**
     * @var \zacksleo\yii2\backend\models\Admin;
     */
    public $model;

    public function setUp()
    {
        parent::setUp();
        $this->model = new Admin();
    }

    public function testRules()
    {
        $this->model->username = "username";
        $this->model->name = "name";
        $this->model->email = "1222.com";
        $this->model->scenario = 'reset';
        $this->model->password_hash = sha1("username");
        $this->assertFalse($this->model->validate());
        $this->model->email = "1222@qq.com";
        $this->assertTrue($this->model->validate());

        $this->model->username = "username ";
        $this->assertFalse($this->model->validate());

        $this->model->username = "username";
        $this->assertTrue($this->model->validate());
        Yii::$app->request->bodyParams  = '';

        $this->model->imageFile = UploadedFile::getInstanceByName('avatar');
        $this->assertTrue($this->model->validate());
    }

    public function testFindIdentity()
    {
        $id = 1;
        $res = Admin::findIdentity($id);
        $this->assertTrue($res->id == $id);
    }

    public function testGetId()
    {
        $model = Admin::findIdentity(1);
        $this->assertTrue($model->getId() == 1);
    }

    public function testValidateAuthKey()
    {
        $model = Admin::findIdentity(1);
        $this->assertTrue($model->validateAuthKey($model->auth_key));
    }

    public function testUpload()
    {
        $model = Admin::findIdentity(1);
        $model->imageFile = UploadedFile::getInstanceByName('imageFile');
        $this->assertTrue($model->upload());
        $this->assertTrue($model->save());
    }

    public function testGetImageUrl()
    {
        $model = Admin::findIdentity(1);
        $url = $model->getImageUrl();
        $res = md5_file($url) == md5_file(__DIR__.'/web/test.jpg');
        $this->assertTrue($res);
    }

    //public function get

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