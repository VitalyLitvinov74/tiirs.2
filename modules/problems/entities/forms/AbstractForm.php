<?php


namespace vloop\problems\entities\forms;


use vloop\problems\entities\interfaces\Form;
use yii\base\Model;

abstract class AbstractForm extends Model implements Form
{

    public function errors(): array
    {
        $new = [];
        foreach ($this->errors as $attribute => $attributeErrors) {
            foreach ($attributeErrors as $concreteError) {
                $new[$attribute] = $concreteError;
            }
        }
        return $new;
    }
}