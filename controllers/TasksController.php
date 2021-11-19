<?php


namespace app\controllers;


use yii\helpers\VarDumper;
use yii\web\Controller;

class TasksController extends Controller
{
    public function actionList(){
        return $this->render('list');
    }

    public function actionView(){
        return $this->render('task-view');
    }
}