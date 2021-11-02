<?php


namespace app\controllers;


use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    public function behaviors()
    {
        Yii::$app->request->enableCsrfValidation = false;
        return parent::behaviors();
    }

    public function actionLogin(){
        return $this->renderPartial('login');
    }
}