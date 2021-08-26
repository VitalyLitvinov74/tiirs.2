<?php


namespace modules\user\entities\interfaces;


use yii\web\IdentityInterface;

interface User
{
    function id(): string;

    function authKey(): string;

    function login(string $password, bool $byAccessToken = false): bool;

    function logout(): bool;

    /**
     * печатает себя в виде массива
    */
    function printYourself():array;

    function isGuest(): bool;
}