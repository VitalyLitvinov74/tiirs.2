<?php


namespace vloop\user;


use Yii;
use yii\base\Module;
use yii\helpers\VarDumper;

class UserModule extends Module
{
    public function init()
    {
        parent::init();
        Yii::$app->setComponents([
            'authManager' => [
                'class' => 'yii\rbac\DbManager',
                'itemTable' => 'vloop_permissions',
                'ruleTable' => 'vloop_rules',
                'assignmentTable' => "vloop_permissions_users",
                'itemChildTable' => 'vloop_role_paths',
            ]
        ]);
    }
}