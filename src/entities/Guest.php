<?php


namespace vloop\users\entities;


use vloop\users\interfaces\User;

class Guest implements User
{

    /**@return int - id пользователя */
    public function id(): int
    {

        return 0;
    }

    /**@return bool - является ли пользователь гостем (NullObject) */
    public function isGuest(): bool
    {
        return true;
    }

    /**
     * @return array - печатает себя в виде массива.
     */
    public function printYourSelf(): array
    {
        return [
            'id'=>$this->id(),
            'name'=>'Гость',
        ];
    }
}