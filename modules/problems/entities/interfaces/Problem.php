<?php


namespace vloop\problems\entities\interfaces;


interface Problem
{
    public function id(): int;

    public function printYourself(): array;

    public function changeStatus(string $status): bool;

    /**
     * добавляет контроллера к задаче
     * @param int $id - ид юзера
     */
    public function attachForeman(int $id);

    /**
     * добавляет исполнителя к задаче
     * @param int $id
     */
    public function attachWorkman(int $id);

    /**
     * открепляет пользователя от задачи,
     * будь это пользователь хоть бригадиром, хоть исполнителем.
     * автора удалить нельзя.
     * @param int $id
     */
    public function detachUser(int $id);
}