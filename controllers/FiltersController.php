<?php


namespace app\controllers;


use yii\web\Controller;

class FiltersController extends Controller
{
    public function actionList(){
        $this->view->title = "Список сохраненных фильтров";
        return $this->render("list");
    }
}