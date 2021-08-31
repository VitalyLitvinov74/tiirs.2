<?php


namespace vloop\user\entities\user;


use vloop\user\entities\interfaces\User;

class Guest implements User
{

    /**
     * @return int - идентификатор пользователя
     */
    function id(): int
    {
        return 0;
    }

    /**
     * @return bool - выходит из системы
     */
    function logout(): bool
    {
        return false;
    }

    /**
     * @return array - печатает себя в виде массива
     */
    function printYourself(): array
    {
        return [];
    }

    /**
     * @return bool - паттерн null object
     */
    function notGuest(): bool
    {
        return false;
    }

    /**
     * @param string $password - пароль или access token
     * @return bool - удачно ли авторизовался
     */
    function login(string $password): array
    {
        return [];
    }

    /**
     * @param string $accessToken
     * @return bool
     */
    public function loginByAccessToken(string $accessToken): bool
    {
        return false;
    }
}