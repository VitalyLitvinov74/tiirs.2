<?php


namespace vloop\problems\entities\report;


use vloop\problems\entities\interfaces\EntitiesList;
use vloop\problems\entities\interfaces\Entity;
use vloop\problems\entities\interfaces\Form;

class ReportsList implements EntitiesList
{
    public function __construct() { }

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
    public function addFromInputForm(Form $form): Entity
    {
        // TODO: Implement addNew() method.
    }

    public function oneByCriteria(array $criteria): Entity
    {
        // TODO: Implement oneByCriteria() method.
    }

    public function remove(Entity $entity): bool
    {
        // TODO: Implement remove() method.
    }
}