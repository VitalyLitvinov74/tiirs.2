<?php


namespace vloop\user\entities\user\decorators;


use Symfony\Component\Console\Exception\LogicException;
use vloop\user\entities\interfaces\User;
use vloop\user\tables\TableUsers;
use Yii;
use yii\base\Exception;
use yii\helpers\VarDumper;
use yii\mutex\RetryAcquireTrait;

class RestUser implements User
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

    function id(): int
    {
        return $this->origin->id();
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
        if (!$this->needleFields) { //если был передан пустой массив.
            return $origArray;
        }
        $new = [];
        foreach ($this->needleFields as $needleField) {
            if (array_key_exists($needleField, $origArray)) {
                $new[$needleField] = $origArray[$needleField];
            }
        }
        return $new;
    }

    function notGuest(): bool
    {
        return $this->origin->notGuest();
    }

    /**
     * @param string $password
     * @return array - удачно ли авторизовался
     */
    function login(string $password): array
    {
        return $this->origin->login($password);
    }
}