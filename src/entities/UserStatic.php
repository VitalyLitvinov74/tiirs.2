<?php


namespace vloop\users\entities;


use vloop\users\entities\BaseUser;
use vloop\users\interfaces\FrameworkAdapter;
use vloop\users\interfaces\User;
use vloop\users\tables\Users;
use Yii;

class UserStatic implements User
{
    private $origin;
    private $name;
    private $authKey;
    private $passwordHash;
    private $framework;

    public function __construct(FrameworkAdapter $framework, User $origin, string $name, $authKey, $passwordHash)
    {
        $this->origin = $origin;
        $this->name = $name;
        $this->authKey = $authKey;
        $this->passwordHash = $passwordHash;
        $this->framework = $framework;
    }

    /**@return string - имя пользователя */
    public function name(): string
    {
        return $this->name;
    }

    /**@return int - id пользователя */
    public function id(): int
    {
        return $this->origin->id();
    }

    /**@return bool - является ли пользователь нулевым */
    public function isGuest(): bool
    {
        return $this->origin->isGuest();
    }


    /**@return bool успешно ли разлогинен пользователь */
    public function logout(): bool
    {
        return $this->origin->logout();
    }

    /**
     * @param string $password
     * @return bool - успешно ли залогинен пользователь
     */
    public function login(string $password): bool
    {
        if ($this->framework->checkPassword($password, $this->passwordHash)) {
            return $this->framework->loginUser($this);
        }
        return false;
    }
}