<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $group_id;
    public $password;
    public $rememberMe = true;

    private $_user_group;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // password is required
            ['password', 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            ['group_id', 'safe'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {

        if (!$this->hasErrors()) {
            $user_group = $this->getUserGroup();
            if (!$user_group || !$user_group->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect password.');
            }
        }
    }

    /**
     * Logs in a user using the provided  password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {

        if ($this->validate()) {
            return Yii::$app->user->login($this->getUserGroup(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }

    /**
     * Finds group by [[groupname]]
     *
     * @return UserGroup|null
     */
    protected function getUserGroup()
    {
        if ($this->_user_group === null) {
            $this->_user_group = UserGroup::findByGroupId($this->group_id);
        }
        return $this->_user_group;
    }
}
