<?php
/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/18
 * Time: 下午12:54
 */

namespace zacksleo\yii2\backend\tests\models;


use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;

class User extends \mdm\admin\models\User
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public function rules()
    {
        return
            [
                [['username', 'email', 'password_hash'], 'required', 'on' => 'reset'],
                ['username', 'match', 'pattern' => '/^[a-z]\w*$/i', 'on' => 'reset'],
                ['password_hash', 'match', 'pattern' => '/\d/', 'message' => '密码至少包含一位数字'],
                ['password_hash', 'match', 'pattern' => '/[a-zA-Z]/', 'message' => '密码至少包含一个字母'],

                ['username', 'filter', 'filter' => 'trim'],
                ['username', 'unique'],
                ['username', 'string', 'min' => 2, 'max' => 255],

                ['email', 'filter', 'filter' => 'trim'],
                ['email', 'email'],
                ['email', 'unique'],

                ['status', 'default', 'value' => self::STATUS_ACTIVE],
                ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],

            ];
    }

    public function beforeSave($insert)
    {
        if (!$this->validate()) {
            throw new InvalidParamException($this->getErrors());
        }
        return parent::beforeSave($insert);
    }
}
