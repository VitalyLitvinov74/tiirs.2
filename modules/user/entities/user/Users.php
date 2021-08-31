<?php


namespace vloop\user\entities\user;


use vloop\user\entities\interfaces\User;
use vloop\user\entities\interfaces\Users as UsersInterface;
use vloop\user\entities\user\decorators\StaticUser;
use vloop\user\tables\TableUsers;
use Yii;
use yii\base\Exception;
use yii\console\widgets\Table;
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
        if ($this->needle) {
            $records->where(['id' => $this->needle]);
        }
        return $records->readAll();
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
        if ($user) {
            return new StaticUser(
                new UserSQL(
                    $user['id']
                ),
                $user['auth_key']
            );
        }
        return $this->guest;
    }

    /**
     * @param string $name - имя (ФИО) пользователя.
     * @param string $login - логин который нужно задать пользователю
     * @param string $password - Пароль который нужно задать пользователю
     * @return User - новый пользователь которого удалось зарегистрировать.
     * @throws Exception
     */
    public function registerNew(string $name, string $login = '', string $password = ''): User
    {
        $secure = Yii::$app->security;
        $login = $this->createLogin($login);
        $password = $this->createPassword($password);
        $record = new TableUsers([
            'name' => $name,
            'login' => $login,
            'password_hash' => $secure->generatePasswordHash($password),
            'access_token' => $secure->generateRandomString(32)
        ]);
        if ($record->save()) {
            return new StaticUser(
                new UserSQL(
                    $record->id
                ),
                $record->auth_key
            );
        }
        return new Guest();
    }

    private function createLogin(string $login)
    {
        if (!$login) {
            $lastID = $this->lastId() + 1;
            $login = 'user' . $lastID;
        }
        $loginNotUnique = !TableUsers::find()->where(['login' => $login])->exists();
        if ($loginNotUnique) {
            $login = $login . rand(0, 100);
            $login = $this->createLogin($login); //рекурсивно прогоняем, и каждый раз проверяем уникальный ли это логин
        }
        return $login;
    }

    private function createPassword(string $password){
        if(!$password){
            $password = time();
        }
        return $password;
    }

    private function lastId()
    {
        $lastID = TableUsers::find()->select('id')->orderBy(['id' => SORT_DESC])->readOne()['id'];
        if (!$lastID) {
            $lastID = 0;
        }
        return $lastID;
    }
}