<?php


namespace vloop\user\entities\forms;


use yii\base\Model;

class LoginForm extends Model
{
    public $login;
    public $password;
    public $scenario;

    public function rules()
    {
        return [
            [['login', 'password', 'scenario'], 'required'],
            [['login', 'password', 'scenario'], 'string', 'max' => 255, 'min' => 4]
        ];
    }

    public function scenarios()
    {
        return [
            'default'=>['login', 'password', 'scenario'],
            'mobile'=>['login', 'password', 'scenario'],
        ];
    }
}