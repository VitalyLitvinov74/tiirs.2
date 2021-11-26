<?php


namespace app\controllers;


use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class AuthController extends Controller
{
    public $layout = 'auth.php';

    public function actionLogin(){
        $this->view->title = "Авторизация";
        return $this->render('login');
    }

    public function actionCreateUser(){
        $this->view->title = "Регистрация";
        return $this->render('create-user');
    }
}