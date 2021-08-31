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
     * @param string $accessToken - пароль или access token
     * @return bool - удачно ли авторизовался
     */
    function login(string $accessToken): bool
    {
        $accessTokenDB = $this->printYourself()['access_token'];
        $userComponent = Yii::$app->user;
        $secure = Yii::$app->security;
        if ($accessTokenDB == $accessToken) {
            try {
                TableUsers::updateAll(
                    ['access_token' => $secure->generateRandomString()],
                    ['id' => $this->id()]
                );
            } catch (Exception $e) {
                throw new LogicException('Не удалось разлогинить предыдущего пользователя');
            }
            $userComponent->login(new IdentityUser($this));
        }
        return false;
    }
}