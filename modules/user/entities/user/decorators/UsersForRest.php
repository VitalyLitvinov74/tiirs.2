<?php


namespace vloop\user\entities\user\decorators;


use vloop\user\entities\interfaces\User;
use vloop\user\entities\interfaces\Users;
use yii\helpers\VarDumper;

class UsersForRest implements Users
{
    private $origin;
    private $position = 0;
    /**@var array*/
    private $arr = false;

    /**
     * @param Users $origin
     */
    public function __construct(Users $origin) {
        $this->origin = $origin;
    }

    /**
     * @return User[]
     */
    public function list(): array
    {
        $origList = $this->origin;
        if($this->arr !== false){
            return $this->arr;
        }
        $this->arr = [];
        foreach ($origList as $user) {
            $userRest = new UserRest(
                $user,
                ['id', 'name']
            );
            $this->arr[] = $userRest->printYourself();
        }
        return $this->arr;
    }

    public function register(): User
    {
        return $this->origin->register();
    }

    public function remove(User $user): bool
    {
        return $this->origin->remove($user);
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


}