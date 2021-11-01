<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;

class VueController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'allow' => false,
                    'denyCallback' => function ($rule, $action) {
                        return $this->redirect(['vue/index']);
                    }
                ],
            ],
            'except' => ['index']
        ];
        return $behaviors;
    }

    public function init()
    {
        Yii::$app->errorHandler->errorAction = 'vue/index';
        parent::init();
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}