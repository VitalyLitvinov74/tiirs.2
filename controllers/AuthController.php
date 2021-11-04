<?php


namespace app\controllers;


use Yii;
use yii\web\Controller;

class AuthController extends Controller
{
    public $layout = 'auth.php';

    public function behaviors()
    {
//        Yii::$app->request->enableCsrfValidation = false;
        return parent::behaviors();
    }

    public function actionLogin(){
        return $this->render('login');
    }

    public function actionCreateFirstUser(){
        return $this->render('create-first-user');
    }
}