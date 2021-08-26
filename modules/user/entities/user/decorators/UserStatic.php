<?php


namespace vloop\user\entities\user\decorators;


use vloop\user\entities\interfaces\User;

class UserStatic implements User
{
    private $authKey;
    private $origin;
    
    public function __construct(User $origin, string $authKey) { 
        $this->authKey = $authKey;
        $this->origin = $origin;
    }

    function id(): string
    {
        return $this->origin->id();
    }

    function authKey(): string
    {
        return $this->authKey;
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
        return $this->origin->printYourself();
    }

    function isGuest(): bool
    {
        return $this->origin->isGuest();
    }
}