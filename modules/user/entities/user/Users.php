<?php


namespace vloop\user\entities\user;


use vloop\user\entities\interfaces\User;
use vloop\user\entities\interfaces\Users as UsersInterface;
use vloop\user\entities\user\decorators\StaticUser;
use vloop\user\tables\TableUsers;
use yii\db\Query;
use yii\helpers\VarDumper;

class Users implements UsersInterface
{
    private $position = 0;
    private $needle;
    private $guest;

    /**
     * Если массив пустой то будет произведен поиск по всем пользователям
     * @param array $ids - массив ид юзеров коотрый нужно получить
     */
    public function __construct(array $ids = [])
    {
        $this->needle = $ids;
        $this->guest = new Guest();
    }

    private function records()
    {
        $records = TableUsers::find()->select(['id', 'auth_key']);
        if ($this->needle){
            $records->where(['id'=>$this->needle]);
        }
        return $records->readAll();
    }


    public function register(): User
    {
        return new Guest();
    }

    public function remove(User $user): bool
    {
        return TableUsers::deleteAll(['id' => $user->id()]);
    }

    /**
     * @return User[]
     */
    public function all(): array
    {
        $records = $this->records();
        $new = [];
        foreach ($records as $record) {
            $new[] = new StaticUser(
                new UserSQL($record['id']),
                $record['auth_key']
            );
        }
        return $new;
    }

    /**
     * Производит поиск в бд, а не в all.
     * @param array $criteria
     * @return User - может вернуть NullObject
     */
    public function oneByCriteria(array $criteria): User
    {
        $user = TableUsers::find()->where($criteria)->readOne();
        if(count($user)){
            return new StaticUser(
                new UserSQL(
                    $user['id']
                ),
                $user['auth_key']
            );
        }
        return $this->guest;
    }
}