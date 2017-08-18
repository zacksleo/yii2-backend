<?php
/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/15
 * Time: 下午3:12
 */

namespace zacksleo\yii2\backend\tests;

use yii;
use yii\base\Exception;
use yii\base\NotSupportedException;
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

        $this->model->username = "username ";           //用户名不能包含空格
        $this->assertFalse($this->model->validate());

        $this->model->username = "1username";           //用户名以字母开头
        $this->assertFalse($this->model->validate());

        $this->model->username = "username";
        $this->assertTrue($this->model->validate());

        $this->model->password_hash = "1111111";        //密码中至少包含一位字母
        $this->assertFalse($this->model->validate());

        $this->model->password_hash = "zxcvbnm";        //密码中至少包含一位数字
        $this->assertFalse($this->model->validate());

        $this->model->password_hash = "zxcvbnm111";
        $this->assertTrue($this->model->validate());

        $this->model->username = "lianluo";             //用户名唯一
        $this->assertFalse($this->model->validate());

        $this->model->username = "username";
        $this->model->imageFile = UploadedFile::getInstanceByName('imageFile');
        $this->assertTrue($this->model->validate());


        $this->model->email = "zacksleo@gmail.com";     //邮箱唯一
        $this->assertFalse($this->model->validate());
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

        $model = new Admin();
        $model->scenario = "reset";
        $model->imageFile = UploadedFile::getInstanceByName('imageFile');
        $this->assertFalse($model->upload());
    }

    public function testGetImageUrl()
    {
        $model = Admin::findIdentity(1);
        $url = $model->getImageUrl();
        //$res = md5_file($url) == md5_file(__DIR__ . '/web/test.jpg');
        //$this->assertTrue($res);
    }

    public function testFindIdentityByAccessToken()
    {
        try {
            Admin::findIdentityByAccessToken('');
        } catch (Exception $e) {
            $this->assertTrue($e instanceof NotSupportedException);
            return;
        }
    }

    public function testValidatePassword()
    {
        $model = Admin::findOne(1);
        $model->validatePassword("1234");
        $this->assertFalse($model->validatePassword("1234"));
        $this->assertTrue($model->validatePassword("1!an1u0"));
    }

    public function testGeneratePasswordResetToken()
    {
        $model = Admin::findOne(1);
        $res = $model->generatePasswordResetToken(true);
        $this->assertTrue($res);
    }

    public function testResetPassword()
    {
        $model = Admin::findOne(1);
        $this->assertTrue($model->resetPassword('lian1uo'));
        $this->assertTrue($model->validatePassword("lian1uo"));
        $this->assertTrue($model->resetPassword('1!an1u0'));
    }

    public function testGenerateAuthKey()
    {
        $model = new Admin();
        $model->generateAuthKey();
        $this->assertTrue(!empty($model->auth_key));
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
            'bigFile' => [
                'name' => 'test.jpeg',
                'type' => 'image/jpeg',
                'size' => 74463,
                'tmp_name' => __DIR__ . '/web/test.jpeg',
                'error' => 0,
            ],
        ];
    }
}
