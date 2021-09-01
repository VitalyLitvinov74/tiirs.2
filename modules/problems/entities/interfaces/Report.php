<?php


namespace vloop\problems\entities\interfaces;


interface Report
{
    public function id(): int;

    public function attachToProblem(Problem $problem): bool;
}