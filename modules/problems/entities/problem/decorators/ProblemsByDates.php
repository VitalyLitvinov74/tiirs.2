<?php


namespace vloop\problems\entities\problem\decorators;


use vloop\problems\entities\interfaces\EntitiesList;
use vloop\problems\entities\interfaces\Entity;
use vloop\problems\entities\interfaces\Form;
use vloop\problems\entities\interfaces\Problem;
use vloop\problems\tables\TableProblems;

class ProblemsByDates implements EntitiesList
{
    private $origin;
    private $dateForm;

    /**
     * ProblemsByDates constructor.
     * @param EntitiesList $origin - первоначаьлный список
     * @param Form $dateForm - форма в которую были переданы данные
     */
    public function __construct(EntitiesList $origin, Form $dateForm) {
        $this->dateForm = $dateForm;
        $this->origin = $origin;
    }

    /**
     * @param array $criteria
     * @return Entity[]
     */
    public function all(array $criteria = []): array
    {
        $all = $this->origin->all();
    }

    /**
     * @param Form $form - форма, которая выдает провалидированные данные
     * @return Entity - Проблема которую нужно решить
     */
    public function addFromInputForm(Form $form): Entity
    {
        return $this->origin->addFromInputForm($form);
    }

    public function oneByCriteria(array $criteria): Entity
    {
        return $this->origin->oneByCriteria($criteria);
    }

    public function remove(Entity $entity): bool
    {
        return $this->origin->remove($entity);
    }
}