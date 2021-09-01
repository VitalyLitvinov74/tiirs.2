<?php


namespace vloop\problems\entities\problem\decorators;


use vloop\problems\entities\interfaces\EntitiesList;
use vloop\problems\entities\interfaces\Problem;
use vloop\problems\entities\interfaces\Role;
use vloop\problems\entities\problem\ProblemsList;

class ProblemFromList implements Problem
{
    private $needle;
    private $list;

    public function __construct(int $needle, ProblemsList $list) {
        $this->list = $list;
        $this->needle = $needle;
    }

    private function problem(): Problem{
        return $this->list->oneByCriteria(['id'=>$this->needle]);
    }

    public function id(): int
    {
        $this->problem()->id();
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
     * добавляет пользователя к задаче
     * @param int $id - ид юзера
     * @param Role $userRoleInProblem
     */
    public function attachUser(int $id, Role $userRoleInProblem)
    {
        // TODO: Implement attachUser() method.
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