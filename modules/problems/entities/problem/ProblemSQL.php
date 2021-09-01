<?php


namespace vloop\problems\entities\problem;

use vloop\problems\entities\interfaces\Problem;
use vloop\problems\entities\problem\ProblemSQL as ProblemInterface;

class ProblemSQL implements Problem
{

    public function __construct(int $id) {

    }

    public function id(): int
    {
        // TODO: Implement id() method.
    }

    public function printYourself(): array
    {
        // TODO: Implement printYourself() method.
    }

    public function changeStatus(string $status): bool
    {
        // TODO: Implement changeStatus() method.
    }

    /**
     * добавляет контроллера к задаче
     * @param int $id - ид юзера
     */
    public function attachForeman(int $id)
    {
        // TODO: Implement attachForeman() method.
    }

    /**
     * добавляет исполнителя к задаче
     * @param int $id
     */
    public function attachWorkman(int $id)
    {
        // TODO: Implement attachWorkman() method.
    }

    /**
     * открепляет пользователя от задачи,
     * будь это пользователь хоть бригадиром, хоть исполнителем.
     * автора удалить нельзя.
     * @param int $id
     */
    public function detachUser(int $id)
    {
        // TODO: Implement detachUser() method.
    }
}