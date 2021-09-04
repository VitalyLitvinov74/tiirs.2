<?php


namespace vloop\problems\entities\problem;


use vloop\problems\entities\interfaces\Entity;
use vloop\problems\entities\interfaces\Form;
use vloop\problems\entities\interfaces\Problem;
use vloop\problems\entities\interfaces\EntitiesList;
use vloop\problems\tables\TableProblems;
use yii\base\Model;

class ProblemsSQL implements EntitiesList
{
    /**
     * @return Problem[]
     */
    public function all(): array
    {
        $all = TableProblems::find()->all();
        $entities = [];
        foreach ($all as $item) {
            $entities[] = new ProblemSQL($item->id);
        }
        return $entities;
    }

    /**
     * @param array $criteria
     * @return Problem
     */
    public function oneByCriteria(array $criteria): Entity
    {
        $record = TableProblems::find()->where($criteria)->one();
        if($record){
            return new ProblemSQL($record->id);
        }
        return new NullProblem(['problem'=>'Проблема не найдена.']);
    }

    /**
     * @param Form $form - форма, которая выдает провалидированные данные
     * @return Entity - Проблема которую нужно решить
     */
    public function addFromInputForm(Form $form): Entity
    {
        if($form->validatedFields()){
            $fields = $form->validatedFields();
            $record = new TableProblems();
            $record->load($fields,'');
            $record->save();
        }
        return new NullProblem($form->errors());
    }

    public function remove(Entity $entity): bool
    {
        return TableProblems::deleteAll(['id'=>$entity->id()]);
    }
}