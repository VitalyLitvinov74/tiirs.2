<?php


namespace vloop\user\entities\interfaces;


use yii\db\Query;

interface Users
{
    /**
     * @return User[]
    */
    public function all(): array;

    /**
     * @return User - новый пользователь которого удалось зарегистрировать.
     */
    public function register(): User;

    /**
     * @param User $user - пользователь которого нужно удалить
     * @return bool - удачно ли удален пользователь из системы
     */
    public function remove(User $user): bool;

    /**
     * Производит поиск в бд, а не в all.
     * @param array $criteria - условия которые нужно применить к выборке
     * @return User - может вернуть NullObject
     */
    public function oneByCriteria(array $criteria): User;
}