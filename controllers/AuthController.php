<?php


namespace app\controllers;


use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class AuthController extends Controller
{
    public $layout = 'auth.php';

    public function actionLogin(){
        return $this->render('login');
    }

    public function actionCreateUser(){
        return $this->render('create-user');
    }
}