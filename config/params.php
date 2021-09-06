<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'dee.migration.path'=>[
        'app\migrations',
        '@vendor/vloop/problems/migrations',
        '@vendor/vloop/users/migrations',
        '@yii/rbac/migrations'
    ]
];
