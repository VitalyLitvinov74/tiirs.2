<?php


namespace vloop\users\entities;


use vloop\users\interfaces\FrameworkAdapter;
use vloop\users\interfaces\User;
use vloop\users\tables\Users;
use Yii;
use yii\console\widgets\Table;
use yii\db\ActiveRecord;

class UserSQL implements User
{
    /**@var Users $table */
    private $table;
    private $id;

    public function __construct(ActiveRecord $table, int $id)
    {
        $this->id = $id;
        $this->table = $table;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        $result = $this->table::find()
            ->where(['id' => $this->id])
            ->one();
        return $result->name;
    }

    /**@return bool - является ли пользователь нулевым */
    public function isGuest(): bool
    {
        return false;
    }

    /**
     * @return array - печатает себя в виде массива.
     */
    public function printYourSelf(): array
    {

    }
}
