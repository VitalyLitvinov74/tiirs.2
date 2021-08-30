<?php


namespace vloop\user\entities\user;


use vloop\user\entities\interfaces\User;
use vloop\user\tables\TableUsers;
use Yii;

class UserByAccessToken implements User
{
    private $accessToken;

    public function __construct(string $accessToken) {
        $this->accessToken = $accessToken;
    }

    function id(): string
    {

    }

    function authKey(): string
    {
        // TODO: Implement authKey() method.
    }

    function login(string $password, bool $byAccessToken = false): bool
    {
        $record = $this->record();
        if(Yii::$app->security->validatePassword($password,$record->password_hash))
    }

    function logout(): bool
    {
        if(Yii::$app->user->isGuest){
           return Yii::$app->user->logout();
        }
        return true;
    }

    /**
     * печатает себя в виде массива
     * @throws \HttpInvalidParamException
     */
    function printYourself(): array
    {
        return $this->record()->toArray();
    }

    /**
     * @return null|array|TableUsers|\yii\db\ActiveRecord
     * @throws \HttpInvalidParamException
     */
    private function record(){
        $record = TableUsers::find()->where(['access_token'=>$this->accessToken])->one();
        if($record){
            return $record;
        }
        throw new \HttpInvalidParamException("Не верный логин или пароль.");
    }
}