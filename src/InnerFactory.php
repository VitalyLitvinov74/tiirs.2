<?php


namespace vloop\users;


use vloop\users\entities\UserSQL;
use vloop\users\entities\UserStatic;
use vloop\users\interfaces\FrameworkAdapter;
use vloop\users\interfaces\User;
use vloop\users\tables\Users;

/**
 * Эта фабрика используется только внутри модуля и нигде больше
 */
final class InnerFactory
{
    private $framework;
    private $tableUsers;

    public function __construct()
    {
        $this->tableUsers = new Users();

    }

    public function userSQL(int $id): User
    {
        return
            new UserSQL(
                $this->userTable(),
                $id
            );
    }

    public function userTable(): Users
    {
        return clone $this->tableUsers;
    }

    public function userStatic(int $id, string $name, string $authKey, string $passwordHash): User
    {
        return
            new UserStatic(
                $this->framework,
                new UserSQL(
                    $this->userTable(),
                    $id
                ),
                $name,
                $authKey,
                $passwordHash
            );
    }
}