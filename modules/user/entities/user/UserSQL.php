<?php


namespace vloop\user\entities\user;

use vloop\user\entities\interfaces\User;
use vloop\user\entities\interfaces\User as UserInterface;
use vloop\user\entities\user\decorators\IdentityUser;
use vloop\user\tables\TableUsers;
use Yii;
use yii\base\Exception;
use yii\web\IdentityInterface;

/**
 * Обработать если такого пользователя не существует.
 */
class UserSQL implements User
{
    private $id;
    private $record = false;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    function id(): int
    {
        return $this->id;
    }

    function login(string $password): bool
    {
        $secure = Yii::$app->security;
        $hash = $this->record()->password_hash;
        $userComponent = Yii::$app->user;
        if ($secure->validatePassword($password, $hash)) {
            try {
                $this->record()->access_token = Yii::$app->security->generateRandomString();
            } catch (Exception $e) {
                throw new \LogicException("Не получилось разлогинить предидузего пользователя.");
            }
            $this->record()->save();
            return $userComponent->login(new IdentityUser($this));
        }
        return false;
    }

    function logout(): bool
    {
        return Yii::$app->user->logout(true);
    }

    /**
     * печатает себя в виде массива
     */
    function printYourself(): array
    {
        return $this->record()->toArray();
    }

    function notGuest(): bool
    {
        return true;
    }

    private function record()
    {
        if ($this->record !== false) {
            return $this->record;
        }
        $this->record = TableUsers::findOne(['id' => $this->id]);
        return $this->record;
    }

//    /**
//     * @param string $accessToken
//     * @return bool
//     */
//    public function loginByAccessToken(string $accessToken): bool
//    {
//        if($this->record()->access_token == $accessToken){
//            return $this->login();
//        }
//        return false;
//    }
//
//    private function login(): bool{
//        try {
//            $this->record()->access_token = Yii::$app->security->generateRandomString();
//        } catch (Exception $e) {
//            return false;
//        }
//        $this->record()->save();
//        return Yii::$app->user->login(new UserIdentity($this));
//    }
}