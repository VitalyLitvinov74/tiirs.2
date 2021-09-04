<?php


namespace vloop\problems\entities\interfaces;


interface Problem extends Entity
{
    /**
     * @param string $status - имя статутса.
     * @return Entity - печатает себя, с новым статусом.
     */
    public function changeStatus(string $status): Entity;

    /**
     * добавляет пользователя к задаче
     * @param int $id - ид юзера
     * @param Role $userRoleInProblem
     * @return Entity - вернет себя же
     */
    public function attachUser(int $id, Role $userRoleInProblem): Entity;

    /**
     * открепляет пользователя от задачи,
     * будь это пользователь хоть бригадиром, хоть исполнителем.
     * автора удалить нельзя.
     * @param int $id
     * @return Entity - вернет себя же, нового
     */
    public function detachUser(int $id): Entity;
}