<?php
return [
    'components'=>[
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => 'vloop_roles',
            'ruleTable' => 'vloop_rules',
            'assignmentTable' => "vloop_permissions",
            'itemChildTable' => 'vloop_role_paths',
        ],
    ]
];