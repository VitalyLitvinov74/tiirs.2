<?php


namespace vloop\problems\entities\report;


use vloop\problems\entities\interfaces\EntitiesList;
use vloop\problems\entities\interfaces\Form;
use vloop\problems\entities\interfaces\Problem;
use vloop\problems\entities\interfaces\Report;
use vloop\problems\tables\TableReports;

class ReportsByCriteriaForm implements
{
    private $form;
    private $list;

    public function __construct(EntitiesList $list, Form $form) {
        $this->list = $list;
        $this->form = $form;
    }

    private function entity(){
        $form = $this->form;
        $fields = $form->validatedFields();
        if($fields){
            return $this->list->oneByCriteria(['id'=>$fields['id']]);
        }
        return new NullReport($form->errors());
    }

    public function id(): int
    {
        return $this->entity()->id();
    }

    public function printYourself(): array
    {
        return $this->entity()->printYourself();
    }

    public function attachToProblem(Problem $problem): bool
    {
        return $this->entity()->attachToProblem($problem);
    }

    public function changeDescription(string $newDescription): bool
    {
        return $this->entity()->changeDescription($newDescription);
    }
}