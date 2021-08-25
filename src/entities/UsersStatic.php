<?php


namespace vloop\users\entities;


use vloop\users\entities\traits\IteratorTrait;
use vloop\users\InnerFactory;
use vloop\users\interfaces\FrameworkAdapter;
use vloop\users\interfaces\User;
use vloop\users\interfaces\Users;
use vloop\users\tables\Users;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;
use yii\web\IdentityInterface;

class UsersStatic implements Users
{
    use IteratorTrait;

    private $factory;
    private $framework;

    public function __construct(FrameworkAdapter $framework)
    {
        $this->factory = new InnerFactory($framework);
        $this->framework = $framework;
    }

    /**
     * @return UserSQL[]
     */
    public function list(): array
    {
        $factory = $this->factory;
        $result = $factory->userTable()::find()->readAll();
        $new = [];
        foreach ($result as $user) {
            $new[$user['id']] =
                $factory->userStatic(
                    $user['id'],
                    $user['name'],
                    $user['auth_key'],
                    $user['password_hash']
                );
        }
        return $new;
    }

    public function register(string $name, string $password): User
    {
        $factory = $this->factory;
        $record = $factory->userTable();
        $record->name = $name;
        $record->password_hash = $this->framework->passwordHash($password);
        $record->auth_key = $this->framework->randomString();
        $record->save();
        $user = $this->factory->userStatic(
            $record->id,
            $record->name,
            $record->auth_key,
            $record->password_hash
        );
        $this->framework->loginUser($user);
        return $user;
    }

    public function remove(User $user): void
    {
        $table = $this->factory->userTable();
        $table::deleteAll(['id' => $user->id()]);
    }
}