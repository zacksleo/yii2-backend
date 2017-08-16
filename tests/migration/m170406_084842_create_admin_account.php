<?php

use yii\db\Migration;
use zacksleo\yii2\backend\models\Admin;

class m170406_084842_create_admin_account extends Migration
{
    public function up()
    {
        $this->insert('{{%admin}}', [
            'auth_key' => Yii::$app->security->generateRandomString(),
            'avatar' => '',
            'username' => 'lianluo',
            'name' => '管理员',
            'email' => 'zacksleo@gmail.com',
            'password_hash' => Yii::$app->security->generatePasswordHash('1!an1u0'),
            'status' => Admin::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);
        echo "管理员账号已创建:　lianluo/1!an1u0\n";
        return true;
    }

    public function down()
    {
        $this->delete('{{%admin}}', [
            'username' => 'lianluo',
            'email' => 'zacksleo@gmail.com',
        ]);
        return true;
    }
}
