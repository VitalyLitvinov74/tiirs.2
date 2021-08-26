<?php


namespace vloop\user\controllers;


use vloop\user\entities\user\UserSQL;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionIndex(){
        $user = new UserSQL(1);
    }
}