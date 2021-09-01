<?php


namespace vloop\problems\entities\problem;

use vloop\problems\entities\interfaces\Problem;
use vloop\problems\entities\interfaces\Role;
use vloop\problems\tables\TableProblems;
use vloop\problems\tables\TableProblemsUsers;

class ProblemSQL implements Problem
{

    private $id;

    public function __construct(int $id) {
        $this->id = $id;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function printYourself(): array
    {
        return $this->record()->toArray();
    }

    public function changeStatus(string $status): bool
    {
        $record = $this->record()->status = $status;
        return $record->save();
    }

    /**
     * открепляет пользователя от задачи,
     * будь это пользователь хоть бригадиром, хоть исполнителем.
     * автора удалить нельзя.
     * @param int $id
     */
    public function detachUser(int $id)
    {
        TableProblemsUsers::deleteAll(['user_id'=>$id]);
    }

    private $record = false;

    /**
     * @return null|array|bool|TableProblems|\yii\db\ActiveRecord
     */
    private function record(){
        if($this->record !== false){
            return $this->record;
        }
        $this->record = TableProblems::find()->where(['id'=>$this->id()])->one();
        return $this->record;
    }

    /**
     * добавляет пользователя к задаче
     * @param int $id - ид юзера
     * @param Role $userRoleInProblem
     * @return bool
     */
    public function attachUser(int $id, Role $userRoleInProblem)
    {
        $record = new TableProblemsUsers();
        $record->user_id = $id;
        $record->role = $userRoleInProblem->type();
        $record->problem_id = $this->id();
        return $record->save();
    }
}