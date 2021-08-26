<?php


namespace modules\user\tables\query;


use yii\db\ActiveQuery;

class UsersQuery extends ActiveQuery
{
    /**
     * Аналог all() только без маппинга в ActiveRecord
    */
    public function readAll(){
        return $this->createCommand()->query()->readAll();
    }

    /**
     * Аналог one() только без маппинга в ActiveRecord
    */
    public function readOne(){
        return $this->createCommand()->query()->read();
    }
}