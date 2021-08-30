<?php


namespace vloop\user\entities\user\decorators;


use vloop\user\entities\interfaces\User;
use yii\helpers\VarDumper;
use yii\mutex\RetryAcquireTrait;

class UserRest implements User
{
    private $origin;
    private $needleFields;

    /**
     * @param User $origin - оргинальный объект
     * @param array $needleFields - поля которые необходимо выдернуть из пользователя (чтобы не печатать приватные поля)
     */
    public function __construct(User $origin, array $needleFields = [])
    {
        $this->origin = $origin;
        $this->needleFields = $needleFields;
    }

    function id(): string
    {
        return $this->origin->id();
    }

    function authKey(): string
    {
        return $this->origin->authKey();
    }

    function login(string $password, bool $byAccessToken = false): bool
    {
        return $this->origin->login($password, $byAccessToken);
    }

    function logout(): bool
    {
        return $this->origin->logout();
    }

    /**
     * печатает себя в виде массива
     */
    function printYourself(): array
    {
        $origArray = $this->origin->printYourself();
        if(!$this->needleFields){ //если был передан пустой массив.
            return  $origArray;
        }
        $new = [];
        foreach ($this->needleFields as $needleField) {
            if(array_key_exists($needleField, $origArray)){
                $new[$needleField] = $origArray[$needleField];
            }
        }
        return $new;
    }

    function isGuest(): bool
    {
        return $this->origin->isGuest();
    }
}