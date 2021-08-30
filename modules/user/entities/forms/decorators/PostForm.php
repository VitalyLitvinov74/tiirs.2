<?php


namespace vloop\user\entities\forms\decorators;


use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

class PostForm
{
    private $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function validated(): bool{
        $post = Yii::$app->request->post();
        if($this->model->load($post, '') and $this->model->validate()){
            return true;
        }
        return false;
    }

    public function errors(): array {
        return $this->model->errors;
    }
}