<?php


namespace vloop\problems\entities\report;


use vloop\problems\entities\interfaces\EntitiesList;
use vloop\problems\entities\interfaces\Entity;
use vloop\problems\entities\interfaces\Form;
use vloop\problems\entities\interfaces\Report;

class ReportsList implements EntitiesList
{

    /**
     * @return Entity[]
     */
    public function all(): array
    {
        // TODO: Implement all() method.
    }

    /**
     * @param Form $form - форма, которая выдает провалидированные данные
     * @return Entity - Проблема которую нужно решить
     */
    public function addNew(Form $form): Entity
    {
        // TODO: Implement addNew() method.
    }

    /**
     * @param array $criteria
     * @return Report
     */
    public function oneByCriteria(array $criteria): Entity
    {
        // TODO: Implement oneByCriteria() method.
    }

    public function remove(Entity $entity): bool
    {
        // TODO: Implement remove() method.
    }
}