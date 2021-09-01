<?php


namespace vloop\problems\entities\interfaces;


interface Entity
{
    public function id(): int;

    public function printYourself(): array;
}