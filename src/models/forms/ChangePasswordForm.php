<?php
namespace zacksleo\yii2\backend\models\forms;

use yii;
use yii\base\InvalidParamException;
use yii\base\Model;
use zacksleo\yii2\backend\models\Admin;

/**
 * Password reset form
 */
class ChangePasswordForm extends Model
{
    public $old_password;
    public $new_password;
    public $new_password_repeat;

    /**
     * @var \zacksleo\yii2\backend\models\Admin
     */
    private $_user;

    /**
     * Creates a form model
     *
     * @param  array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($config = [])
    {
        $this->_user = Admin::findOne(Yii::$app->user->id);
        if (!$this->_user) {
            throw new InvalidParamException('用户不存在');
        }
        parent::__construct($config);
    }

    public function attributeLabels()
    {
        return [
            'old_password' => '旧密码',
            'new_password' => '新密码',
            'new_password_repeat' => '重新输入新密码',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['old_password', 'new_password', 'new_password_repeat'], 'required'],
            [['new_password', 'new_password_repeat'], 'string', 'min' => 6],
            ['new_password_repeat', 'compare', 'compareAttribute' => 'new_password'],

            ['new_password', 'match', 'pattern' => '/\d/', 'message' => '密码至少包含一位数字'],
            ['new_password', 'match', 'pattern' => '/[a-zA-Z]/', 'message' => '密码至少包含一个字母'],

            ['old_password', 'verifyOldPassword', 'message' => '旧密码不正确'],
        ];
    }

    /**
     * 验证原来密码
     * @inheritdoc
     */
    public function verifyOldPassword($attribute, $params)
    {
        if (!$this->_user->validatePassword($this->old_password)) {
            $this->addError($attribute, '旧密码不正确');
        }
    }

    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function resetPassword()
    {
        return $this->_user->resetPassword($this->new_password);
    }
}
