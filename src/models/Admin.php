<?php
namespace zacksleo\yii2\backend\models;

use yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\behaviors\TimestampBehavior;
use zacksleo\yii2\backend\models\queries\AdminQuery;
use zacksleo\yii2\backend\Module;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property integer $role
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $password_hash write-only password
 * @property string $avatar
 * @property string $auth_key
 * @property string $name
 * @property string $password_rest_token
 * @property string $email_confirmation_token
 * @property UploadedFile $imageFile
 */
class Admin extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    public $imageFile;

    public $isAdmin = true;

    /**
     * @var string|null the current password value from form input
     */
    protected $_password;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }

    /**
     * @return AdminQuery custom query class with user scopes
     */
    public static function find()
    {
        return new AdminQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return array_merge(parent::scenarios(), [
            'reset' => ['username', 'email', 'password_hash'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'mobilephone', 'password_hash'], 'required', 'on' => 'reset'],
            ['username', 'match', 'pattern' => '/^[a-z]\w*$/i', 'on' => 'reset'],
            ['password_hash', 'match', 'pattern' => '/\d/', 'message' => '密码至少包含一位数字', 'on' => 'reset'],
            ['password_hash', 'match', 'pattern' => '/[a-zA-Z]/', 'message' => '密码至少包含一个字母', 'on' => 'reset'],

            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],

            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'unique', 'on' => 'reset'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['name', 'string', 'max' => '20'],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['email', 'unique', 'on' => 'reset'],
            ['avatar', 'safe'],
            [
                ['imageFile'],
                'file',
                'skipOnEmpty' => true,
                'extensions' => 'png, jpg',
                'maxFiles' => 1,
                'maxSize' => 300000
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'avatar' => Module::t('backend', 'avatar'),
            'id' => Module::t('backend', 'id'),
            'username' => Module::t('backend', 'username'),
            'email' => Module::t('backend', 'email'),
            'is_email_verified' => Module::t('backend', 'is email verified'),
            'password_hash' => Module::t('backend', 'password'),
            'status' => Module::t('backend', 'status'),
            'created_at' => Module::t('backend', 'create time'),
            'updated_at' => Module::t('backend', 'update time'),
            'imageFile' => '上传头像',
            'name' => '姓名'
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->setPassword($this->password_hash);
        }
        if (Yii::$app->request->isPost && isset($_POST['Admin']['imageFile'])) {
            $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
            if (!empty($this->imageFile) && !$this->upload()) {
                $this->addError('avatar', $this->imageFile->getHasError());
                return false;
            }
        }
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
        if (!empty($password)) {
            $this->password_hash = Yii::$app->security->generatePasswordHash($password);
        }
    }

    /**
     * @return string|null the current password value, if set from form. Null otherwise.
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new email confirmation token
     * @param bool $save whether to save the record. Default is `false`.
     * @return bool|null whether the save was successful or null if $save was false.
     */
    public function generateEmailConfirmationToken($save = false)
    {
        $this->email_confirmation_token = Yii::$app->security->generateRandomString() . '_' . time();
        if ($save) {
            return $this->save();
        }
    }

    /**
     * Generates new password reset token
     * @param bool $save whether to save the record. Default is `false`.
     * @return bool|null whether the save was successful or null if $save was false.
     */
    public function generatePasswordResetToken($save = false)
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
        if ($save) {
            return $this->save();
        }
    }

    /**
     * Resets to a new password and deletes the password reset token.
     * @param string $password the new password for this user.
     * @return bool whether the record was updated successfully
     */
    public function resetPassword($password)
    {
        $this->setPassword($password);
        $this->password_reset_token = null;
        return $this->save();
    }

    /**
     * 上传头像
     * @return bool
     */
    public function upload()
    {
        if ($this->validate()) {
            $path = date('Ymd') . '/';
            $fullpath = \Yii::getAlias('@app') . '/web/uploads/' . $path;
            if (!file_exists($fullpath)) {
                mkdir($fullpath);
            }
            $filename = uniqid() . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($fullpath . $filename);
            $this->avatar = $path . $filename;
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取头像地址
     * @return string
     */
    public function getImageUrl()
    {
        if (empty($this->avatar)) {
            return Url::to('/images/avatar.jpg');
        }
        return Url::to('@web/uploads/' . $this->avatar, true);
    }
}
