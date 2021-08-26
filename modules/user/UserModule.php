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
                'itemTable' => 'vloop_roles',
                'ruleTable' => 'vloop_rules',
                'assignmentTable' => "vloop_permissions",
                'itemChildTable' => 'vloop_role_paths',
            ]
        ]);
    }
}