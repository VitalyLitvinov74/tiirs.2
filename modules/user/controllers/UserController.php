<?php


namespace vloop\user\controllers;


use vloop\user\entities\user\UserSQL;
use yii\helpers\VarDumper;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionLogin(){
        $this->layout = '@app/views/layouts/loginPage';
        return $this->render("login");
    }
}