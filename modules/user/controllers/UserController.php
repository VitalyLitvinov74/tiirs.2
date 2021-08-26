<?php


namespace modules\user\controllers;


use modules\user\entities\user\UserSQL;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionIndex(){
        $user = new UserSQL(1);
    }
}