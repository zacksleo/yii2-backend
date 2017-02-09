<?php
namespace zacksleo\yii2\backend\models\queries;

use yii\db\ActiveQuery;
use zacksleo\yii2\backend\models\Admin;

class AdminQuery extends ActiveQuery
{
    /**
     * @return AdminQuery the query with conditions for users that can login applied
     */
    public function canLogin()
    {
        return $this->andWhere([
            'status' => Admin::STATUS_ACTIVE,
        ]);
    }

    /**
     * @return UserQuery the query with condition for given email applied
     */
    public function email($email)
    {
        return $this->andWhere(['email' => $email]);
    }

    /**
     * @return UserQuery the query with condition for given username applied
     */
    public function username($username)
    {
        return $this->andWhere(['username' => $username]);
    }

    /**
     * @param string $token the password reset token
     * @return UserQuery the query with conditions for valid password reset token applied
     */
    public function passwordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return $this->andWhere('FALSE');
        }
        return $this->andWhere(['password_reset_token' => $token]);
    }

    /**
     * @param string $token the email confirmation token
     * @return UserQuery the query with conditions for valid email confirmation token applied
     */
    public function emailConfirmationToken($token)
    {
        $expire = \Yii::$app->params['user.emailConfirmationTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return $this->andWhere('FALSE');
        }
        return $this->andWhere(['email_confirmation_token' => $token]);
    }
}
