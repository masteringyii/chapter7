<?php

namespace app\models;
use Yii;

class UserForm extends \yii\base\Model
{
	public $email;
	public $password;
	public $name;

	private $_user = false;

	public function rules()
	{
		return [
			[['email', 'password'], 'required'],
			[['email'], 'email'],
			[['email', 'password', 'name'], 'string', 'max' => 255],
			[['email', 'password'], 'required', 'on' => 'login'],
			[['email', 'password', 'name'], 'required', 'on' => 'register'],
			[['password'], 'validatePassword', 'on' => 'login'],
		];
	}

	public function scenarios()
	{
		return [
			'login' => ['email', 'password'],
			'register' => ['email', 'password', 'name']
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
        if (!$this->hasErrors())
        {
            if (!$this->getUser() || !$this->getUser()->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect email or password.');
            }
        }
    }

    /**
     * Registration method to run on the register scenario
     * @return boolean
     */
    public function register()
    {
        if ($this->validate())
        {
            $user = new User;
            $user->attributes = [
                'email'     => $this->email,
                'password'  => password_hash($this->password, PASSWORD_BCRYPT, ['cost' => 13])
            ];
            
            $user->setFullName($this->name);

            return $user->save();
        }

        return false;
    }

    /**
     * Logs in a user using the provided email and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate())
            if (Yii::$app->user->login($this->getUser()))
                return true;
        
        return false;
    }

    /**
     * Finds user by [[email]]
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false)
            $this->_user = User::findOne(['email' => $this->email]);

        return $this->_user;
    }
}
