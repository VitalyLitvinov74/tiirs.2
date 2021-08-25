<?php


namespace vloop\users\interfaces;

use yii\web\IdentityInterface;

interface User
{
    /**@return int - id пользователя */
    public function id(): int;

    /**@return bool - является ли пользователь гостем (NullObject) */
    public function isGuest(): bool;

    /**
     * @return array - печатает себя в виде массива.
    */
    public function printYourSelf(): array;
}