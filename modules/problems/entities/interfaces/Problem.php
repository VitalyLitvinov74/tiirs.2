<?php


namespace vloop\problems\entities\interfaces;


interface Problem extends Entity
{
    public function changeStatus(string $status): bool;

    /**
     * добавляет пользователя к задаче
     * @param int $id - ид юзера
     * @param Role $userRoleInProblem
     */
    public function attachUser(int $id, Role $userRoleInProblem);

    /**
     * открепляет пользователя от задачи,
     * будь это пользователь хоть бригадиром, хоть исполнителем.
     * автора удалить нельзя.
     * @param int $id
     */
    public function detachUser(int $id);
}