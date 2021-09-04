<?php


namespace vloop\problems\entities\forms;


use vloop\problems\entities\interfaces\Form;
use Yii;
use yii\base\Model;

class AddProblemForm extends AbstractForm
{
    public $author_id;
    public $status;
    public $description;
    public $period_of_execution;
    public $time_of_creation;

    public function rules()
    {
        return [
            [['author_id', 'description'], 'required'],
            [['description', 'status'], 'string'],
            [['time_of_creation', 'period_of_execution', 'author_id'], 'integer'],
            [['status'], 'statusValidate'],
            ['period_of_execution','default', 'value' => 0],
            ['time_of_creation', 'default', 'value' => time()]
        ];
    }

    public function validatedFields(): array
    {
        $post = Yii::$app->request->post();
        if ($this->load($post, '') and $this->validate()) {
            return $this->attributes;
        }
        return [];
    }
}