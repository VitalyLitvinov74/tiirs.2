<?php


namespace vloop\problems\entities\interfaces;


interface Report extends Entity
{
    public function attachToProblem(Problem $problem): bool;

    public function changeDescription(string $newDescription): bool;
}