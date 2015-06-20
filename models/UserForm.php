<?php

namespace app\models;
use Yii;

class UserForm extends \yii\base\Model
{
	public $email;
	public $password;
	public $name;

	public function rules()
	{
		return [
			[['email', 'password'], 'required'],
			[['email'], 'email'],
			[['email', 'password', 'name'], 'string', 'max' => 255],
			[['email', 'password'], 'required', 'on' => 'login'],
			[['email', 'password', 'name'], 'required', 'on' => 'register'],
		];
	}

	public function scenarios()
	{
		return [
			'login' => ['email', 'password'],
			'register' => ['email', 'password', 'name']
		];
	}
}
