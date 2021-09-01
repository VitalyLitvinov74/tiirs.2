<?php


namespace vloop\problems\entities\interfaces;


interface Problems
{
    /**
     * @return Problem[]
    */
    public function all(): array;

    /**
     * @param Form $form - форма, которая выдает провалидированные данные
     * @return Problem - Проблема которую нужно решить
     */
    public function addNew(Form $form): Problem;

    public function oneByCriteria(): Problem;

    public function remove(Problem $problem): bool ;
}