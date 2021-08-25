<?php


namespace vloop\users\tables\query;


use yii\db\ActiveQuery;

class BaseQuery extends ActiveQuery
{
    public function readAll(){
        return $this->createCommand()
            ->query()
            ->readAll();
    }

    public function readOne(){
        return $this->createCommand()
            ->query()
            ->read();
    }
}