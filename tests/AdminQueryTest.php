<?php
/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/17
 * Time: 下午4:16
 */

namespace yii\web;

use zacksleo\yii2\backend\models\Admin;
use zacksleo\yii2\backend\models\queries\AdminQuery;
use zacksleo\yii2\backend\tests\TestCase;
use yii;

class AdminQueryTest extends TestCase
{
    public function testQuery()
    {
        $modelClass = new Admin();
        $query = new AdminQuery($modelClass);
        $query->init();
        $query->canLogin();
        $query->email("zacksleo@gmail.com");
        $query->username("lianluo");
        $this->assertTrue($query->count() > 0);
        $query->passwordResetToken("_" . time());
        $query->emailConfirmationToken("222_0");

        $this->assertFalse($query->count() > 0);
    }
}
