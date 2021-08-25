<?php


namespace vloop\users\entities;


use vloop\users\tables\Users;
use yii\web\IdentityInterface;

class BaseUser
{
    protected $id;

    public static function findIdentity($id)
    {
        $record = Users::find()->where(['id' => $id])->one();
        if ($record) {
            return new self($id);
        }
        return null; //вконце работы переделать на null object
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface|null the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null; //вконце работы переделать на null object
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     * The space of such keys should be big enough to defeat potential identity attacks.
     * The returned key is used to validate session and auto-login (if [[User::enableAutoLogin]] is enabled).
     * Make sure to invalidate earlier issued authKeys when you implement force user logout, password change and
     * other scenarios, that require forceful access revocation for old sessions.
     * @return string|null a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        $key = Users::find()
            ->select('auth_key')
            ->where(["id"=>$this->id])
            ->one();
        if(isset($key->auth_key)){
            return $key->auth_key;
        }
        return null;
    }

    /**
     * Validates the given auth key.
     * @param string $authKey the given auth key
     * @return bool|null whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        if($this->getAuthKey() == $authKey){
            return true;
        }
        return false;
    }
}