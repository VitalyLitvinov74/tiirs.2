<?php


namespace vloop\user\entities\interfaces;


interface Users extends \Iterator
{
    /**
     * @return User[]
    */
    public function list(): array;

    public function register(): User;

    public function remove(User $user): bool;
}