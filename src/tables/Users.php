<?php


namespace vloop\users\tables;


use vloop\users\tables\query\BaseQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
/**
 * @property int $id
 * @property string $name
 * @property string $password_hash [varchar(255)]
 * @property string $auth_key [varchar(255)]
 */
class Users extends ActiveRecord
{
    public static function tableName()
    {
        return 'vloop_users';
    }

    public static function find()
    {
        return new BaseQuery(get_called_class());
    }
}