<?php


namespace vloop\problems\entities\problem;


use vloop\problems\entities\interfaces\Entity;
use vloop\problems\entities\interfaces\Form;
use vloop\problems\entities\interfaces\Problem;
use vloop\problems\entities\interfaces\EntitiesList;

class ProblemsList implements EntitiesList
{

    /**
     * @return Problem[]
     */
    public function all(): array
    {
        // TODO: Implement all() method.
    }


    /**
     * @param array $criteria
     * @return Problem
     */
    public function oneByCriteria(array $criteria): Entity
    {
        // TODO: Implement oneByCriteria() method.
    }

    /**
     * @param Form $form - форма, которая выдает провалидированные данные
     * @return Entity - Проблема которую нужно решить
     */
    public function addNew(Form $form): Entity
    {
        // TODO: Implement addNew() method.
    }

    public function remove(Entity $entity): bool
    {
        // TODO: Implement remove() method.
    }
}