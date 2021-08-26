<?php


namespace vloop\user\tables;


use vloop\user\tables\query\UsersQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property int $id [int(11)]
 * @property string $name [varchar(32)]
 * @property string $password_hash [varchar(32)]
 * @property string $auth_key [varchar(32)]
 */
class TableUsers extends ActiveRecord
{

    public static function tableName()
    {
        return 'vloop_users'; // TODO: Change the autogenerated stub
    }

    static function find()
    {
        return new UsersQuery(get_called_class()); // TODO: Change the autogenerated stub
    }
}