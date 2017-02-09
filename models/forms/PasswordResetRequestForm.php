<?php
namespace zacksleo\yii2\backend\models\forms;

use Yii;
use yii\base\Model;
use zacksleo\yii2\backend\models\Admin;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\zacksleo\yii2\backend\models\Admin',
                'filter' => ['status' => Admin::STATUS_ACTIVE],
                'message' => 'There is no user with this email address.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user Admin */
        $user = Admin::find()->canLogin()->email($this->email)->one();

        if (!$user) {
            return false;
        }

        if ($user && $user->generatePasswordResetToken(true)) {
            $params = Yii::$app->params;
            $mailer = Yii::$app->mailer;
            //$mailer->htmlLayout = '@vendor/zacksleo/yii2-backend/mail/layouts/html';
            return $mailer->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user])
                ->setFrom([$params['support.email'] => $params['support.name']])
                ->setTo($this->email)
                ->setSubject('Password reset for ' . Yii::$app->name)
                ->send();
        }
        return false;
    }
}
