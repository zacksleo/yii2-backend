<?php

namespace yii\web;

/**
 * Mock for the is_uploaded_file() function for web classes.
 * @return boolean
 */
function is_uploaded_file($filename)
{
    return file_exists($filename);
}

/**
 * Mock for the move_uploaded_file() function for web classes.
 * @return boolean
 */
function move_uploaded_file($filename, $destination)
{
    return copy($filename, $destination);
}

namespace zacksleo\yii2\backend\tests;

use PHPUnit_Framework_TestCase;
use yii\helpers\ArrayHelper;
use yii;

/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/15
 * Time: 上午11:33
 */
class TestCase extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->mockWebApplication();
        $this->createTestData();
    }

    public function createTestData()
    {
        $adminSql = <<<EOF
        -- auto-generated definition
        create table test_admin
        (
            id int auto_increment
                primary key,
            auth_key varchar(125) null,
            avatar varchar(255) null comment '头像',
            username varchar(20) not null comment '用户名',
            name varchar(20) not null comment '姓名',
            email varchar(64) not null comment '邮箱',
            password_hash varchar(64) not null comment '密码',
            password_reset_token varchar(255) null comment '重置密码Token',
            status tinyint(1) default '1' not null comment '状态',
            created_at int not null comment '创建时间',
            updated_at int not null comment '更新时间'
        )
        comment '管理员';  
        INSERT INTO test.test_admin 
        (
        auth_key, avatar, username, name, email, password_hash, password_reset_token, status, created_at, updated_at
        ) 
        VALUES 
        (
        'CccLhn6aqp_Y-XYh-JzfXSCfxJNkKC8w', '', 'lianluo', '管理员', 'zacksleo@gmail.com', '$2y$13\$dbGxVyj3kglcJNUEsKyiu.5KQ9We3AqAFncYkdAS1iNRYf/RA37Ay', null, 1, 1502856859, 1502856859
        );
EOF;
        $userSql = <<<EOF
        -- auto-generated definition
        create table test_user
        (
            id int auto_increment
                primary key,
            avatar varchar(255) null comment '头像',
            phone varchar(15) not null comment '手机号',
            created_at int not null comment '创建时间',
            updated_at int not null comment '更新时间',
            union_id varchar(255) not null comment 'UnionID',
            easemob_username varchar(255) null comment '环信用户名'
        )
        ;
EOF;
        $menuSql = <<<EOF
        -- auto-generated definition
        create table test_admin_menu
        (
            id int auto_increment
                primary key,
            name varchar(128) not null,
            parent int null,
            route varchar(255) null,
            `order` int null,
            data blob null
        );
EOF;
        try {
            $db = Yii::$app->getDb();
            $db->createCommand($adminSql)->execute();
            $db->createCommand($userSql)->execute();
            $db->createCommand($menuSql)->execute();
        } catch (yii\db\Exception $e) {
            //var_dump($e->getMessage());
            return;
        }
    }

    protected function mockWebApplication()
    {
        $appClass = "\yii\web\Application";
        $this->mockApplication([], $appClass);
    }

    protected function mockConsoleApplication()
    {
        $appClass = "\yii\console\Application";
        return $this->mockApplication([], $appClass);
    }

    protected function mockApplication($config = [], $appClass = '\yii\console\Application')
    {
        $config['params']=[
            'user.passwordResetTokenExpire'=>3600,
            'user.emailConfirmationTokenExpire' => 3600,
            'admin.email' => 'admin@example.com',
            'support.email' => 'feedback@moguyun.net.cn',
            'support.name' => '技术支持',
        ];

         new $appClass(ArrayHelper::merge([
            'id' => 'testapp',
            'basePath' => __DIR__,
            'vendorPath' => $this->getVendorPath(),
            'components' => [
                'db' => [
                    'class' => 'yii\db\Connection',
                    'dsn' => 'mysql:host=localhost:3306;dbname=test',
                    'username' => 'root',
                    'password' => '123456',
                    'charset' => 'utf8',
                    'tablePrefix' => 'test_'
                ],
                'i18n' => [
                    'translations' => [
                        '*' => [
                            'class' => 'yii\i18n\PhpMessageSource',
                        ]
                    ]
                ],
                'user' => [
                    'identityClass' => 'zacksleo\yii2\backend\tests\model\User',
                ]
            ],
            'modules' => [
                'backend' => [
                    'class' => 'zacksleo\yii2\backend\Module',
                    'controllerNamespace' => 'zacksleo\yii2\backend\tests\controllers'
                ]
            ]
        ], $config));
        \Yii::setAlias('@web', __DIR__.'/web');
    }

    private function getVendorPath()
    {
        return dirname(__DIR__) . '/vendor';
    }

}