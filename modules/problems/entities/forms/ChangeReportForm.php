<?php


namespace vloop\problems\entities\forms;


use Yii;

class ChangeReportForm extends AbstractForm
{
    public $id;
    public $newDescription;

    public function rules()
    {
        return [
            [['id', 'newDescription'], 'required'],
            ['id', 'int'],
            ['newDescription', 'string']
        ];
    }

    public function validatedFields(): array
    {
        $post = Yii::$app->request->post();
        if($this->load($post, '') and $this->validate()){
            return $this->attributes;
        }
        return [];
    }
}