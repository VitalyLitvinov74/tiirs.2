<?php


namespace vloop\user\entities\forms;


use yii\base\Model;

class CreateForm extends Model
{
    public $password;
    public $name;
    public $login;

    public function rules()
    {
        return [
            ['name', 'required'],
            [['name', 'password', 'login'], 'string', 'min'=>4, 'max'=>32]
        ];
    }
}