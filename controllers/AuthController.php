<?php


namespace app\controllers;


use vloop\entities\decorators\ResetKeysOnListEntities;
use vloop\users\oop\entities\UsersSQL;
use Yii;
use yii\helpers\Url;
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

    public function actionCreateUser(){
        return $this->render('create-user');
    }
}