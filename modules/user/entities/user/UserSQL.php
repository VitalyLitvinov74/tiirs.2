<?php


namespace modules\user\entities\user;

use modules\user\entities\interfaces\User;
use modules\user\entities\interfaces\User as UserInterface;
use modules\user\entities\user\decorators\UserIdentity;
use modules\user\tables\TableUsers;
use Yii;
use yii\web\IdentityInterface;

/**
 * Обработать если такого пользователя не существует.
 */
class UserSQL implements User
{
    private $id;
    private $record = false;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    function id(): string
    {
        return $this->id;
    }

    function authKey(): string
    {
        return $this->record()->auth_key;
    }

    function login(string $password, bool $byAccessToken = false): bool
    {
        $security = Yii::$app->security;
        if($byAccessToken and $this->validAccessToken($password)){
            return Yii::$app->user->login(new UserIdentity($this));
        }else if($this->validPassword($password)){
            return Yii::$app->user->login(new UserIdentity($this));
        }
        return false;
    }

    function logout(): bool
    {
        return Yii::$app->user->logout(true);
    }

    /**
     * печатает себя в виде массива
     */
    function printYourself(): array
    {
        return $this->record()->toArray();
    }

    function isGuest(): bool
    {
        return false;
    }

    private function record()
    {
        if ($this->record !== false) {
            return $this->record;
        }
        $this->record = TableUsers::findOne(['id' => $this->id]);
        return $this->record;
    }

    private function validPassword(string $password): bool{
        return Yii::$app->security->validatePassword($password, $this->record()->password_hash);
    }

    private function validAccessToken(string $accessToken): bool{
        return $this->record()->access_token == $accessToken;
    }
}