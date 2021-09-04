<?php


namespace vloop\problems\entities\problem;


use vloop\problems\entities\interfaces\Problem;
use vloop\problems\entities\interfaces\Role;

class NullProblem implements Problem
{
    private $self;

    public function __construct(array $self) {
        $this->self = $self;
    }

    public function id(): int
    {
        return 0;
    }

    public function printYourself(): array
    {
        return $this->self;
    }

    public function changeStatus(string $status): array
    {
        return $this->printYourself();
    }

    /**
     * добавляет пользователя к задаче
     * @param int $id - ид юзера
     * @param Role $userRoleInProblem
     */
    public function attachUser(int $id, Role $userRoleInProblem)
    {

    }

    /**
     * открепляет пользователя от задачи,
     * будь это пользователь хоть бригадиром, хоть исполнителем.
     * автора удалить нельзя.
     * @param int $id
     */
    public function detachUser(int $id)
    {

    }
}