<?php


namespace app\controllers;


use yii\helpers\VarDumper;
use yii\web\Controller;

class TasksController extends Controller
{
    public function actionList(){
        $this->view->title = "Список задач";
        return $this->render('list');
    }

    public function actionView(){
        $this->view->title = "Информация о задаче";
        return $this->render('task-view');
    }
}