<?php


namespace vloop\user\entities\user;


use vloop\user\entities\interfaces\User;
use vloop\user\entities\interfaces\Users;
use vloop\user\entities\user\deco\UserStatic;
use vloop\user\entities\user\decorators\UserStatic;
use vloop\user\tables\TableUsers;
use yii\db\Query;

class UsersByIds implements Users
{
    private $position = 0;
    private $needle;

    /**
     * Если массив пустой то будет произведен поиск по всем пользователям
     * @param array $ids - массив ид юзеров коотрый нужно получить
     */
    public function __construct(array $ids = [])
    {
        $this->needle = $ids;
    }


    /**
     * Return the current element
     * @link https://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->list()[$this->position];
    }

    /**
     * Move forward to next element
     * @link https://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * Return the key of the current element
     * @link https://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Checks if current position is valid
     * @link https://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return isset($this->list()[$this->position]);
    }

    /**
     * Rewind the Iterator to the first element
     * @link https://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return User[]
     */
    public function list(): array
    {
        $records = TableUsers::find()
            ->select(['id', 'auth_key'])
            ->where(['id' => $this->needle])
            ->readAll();
        $new = [];
        foreach ($records as $record) {
            $new[$record['id']] = new UserStatic(
                new UserSQL($record['id']),
                $record['auth_key']
            );
        }
        return $new;
    }

    public function register(): User
    {

    }

    public function remove(User $user): bool
    {
        return TableUsers::deleteAll(['id' => $user->id()]);
    }
}