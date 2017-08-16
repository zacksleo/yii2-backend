<?php
use yii\db\Migration;

/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/2
 * Time: 下午4:45
 */
class m170802_164345_alter_user_table extends Migration
{

    public function up()
    {
        $this->addColumn('{{%user}}', 'easemob_username', "string");
        $this->addCommentOnColumn('{{%user}}','easemob_username', '环信用户名');
        echo "添加环信账号用户名字段 成功\r\n";
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'easemob_username');
        echo "删除环信账号用户名字段 成功\r\n";
    }

}